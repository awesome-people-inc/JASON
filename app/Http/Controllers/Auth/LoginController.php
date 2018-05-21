<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Webpatser\Uuid\Uuid;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser  = User::where('email', $user->email)->first();
        $avatar = "";
        $location = "";
        $url = "";
        $headline = "";

        switch ($provider)
        {
            case 'github':
                $avatar = $user->user['avatar_url'];
                $location = $user->user['location'];
                $url = $user->user['html_url'];
                $headline = $user->user['bio'];
                break;
            case 'facebook':
                $avatar = $user->avatar_original;
                $url = $user->profileUrl;
                break;
            case 'google':
                $avatar = $user->avatar_original;
                if (isset($user->user['url']))
                {
                    $url = $user->user['url'];
                }
                if (isset($user->user['tagline']))
                {
                    $headline = $user->user['tagline'];
                }
                break;
            case 'linkedin':
                $avatar = $user->user['pictureUrl'];
                $url = $user->user['publicProfileUrl'];
                $location = $user->user['location']['name'];
                $headline = $user->user['headline'];
                break;
        }
        if ($authUser)
        {
            if ($authUser->provider != $provider)
            {
                Profile::where('user_id', $authUser->id)->where($provider.'_id', null)->update([
                    $provider.'_id' => $user->id,
                    $provider.'_url' => $url
                ]);

                Profile::where('user_id', $authUser->id)->where('avatar', null)->update([
                    'avatar' => $avatar
                ]);
            }

            if ($provider == 'github' && $authUser->profile->github_nickname == null)
            {
                Profile::where('user_id', $authUser->id)->update([
                    'github_nickname' => $user->nickname
                ]);
            }
            return $authUser;
        }

        $id = Uuid::generate()->string;

        $user_data = User::create([
            'name' =>  $user->name,
            'email' =>  $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'uuid' => $id,
            'avatar' => $avatar
        ]);

        Profile::create([
            'user_id' => $user_data->id,
            'location' => $location,
            'headline' => $headline,
            $provider.'_url' => $url,
            $provider.'_id' => $user->id,
            'github_nickname' => ($provider == 'github') ? $user->nickname : "",
        ]);

        return $user_data;

    }
}
