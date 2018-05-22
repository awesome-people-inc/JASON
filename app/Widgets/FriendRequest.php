<?php

namespace App\Widgets;

use App\User;
use Arrilot\Widgets\AbstractWidget;

class FriendRequest extends AbstractWidget
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
        return view('widgets.friend_request', [
            'user1' => $user
        ]);
    }
}
