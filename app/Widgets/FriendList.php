<?php

namespace App\Widgets;

use App\User;
use Arrilot\Widgets\AbstractWidget;

class FriendList extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run($id)
    {
        $user = User::find($id);
        dd(\Auth::user()->getFriends());

        return view('widgets.friend_list', [
            'user1' => $user
        ]);
    }
}
