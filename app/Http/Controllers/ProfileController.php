<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($uuid)
    {
        $authUser = Auth::user();
        $user = User::with('profile')->where('uuid', $uuid)->first();
        if ($authUser->isBlockedBy($user))
        {
            return view('error.blocked');
        }
        return view('profile.index')->with(['user' => $user]);
    }
}
