<?php

namespace App\Widgets;

use App\Post;
use App\User;
use Arrilot\Widgets\AbstractWidget;

class Feeds extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    public $reloadTimeout = 5;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run($id, $isProfilePage)
    {
        $idArr = array();
        $user = User::find($id);
        $friends = $user->getFriends();
        if (!$isProfilePage)
        {
            foreach ($friends as $k => $v)
            {
                array_push($idArr, $v['id']);
            }
        }
        array_push($idArr, $user->id);
        $posts = Post::whereIn('user_id', $idArr)->orderByDesc('created_at')->take(10)->get();
        return view('widgets.feeds', [
            'posts' => $posts,
        ]);
    }

    public function placeholder()
    {
        return "<h4>It's a slow day!</h4>";
    }
}
