<?php
/**
 * Created by PhpStorm.
 * User: Nitish Kumar
 * Date: 4/22/2018
 * Time: 2:39 AM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function sendRequest($receipient)
    {
        $sender = Auth::user();
        $receipient = User::findOrFail($receipient);
        $sender->befriend($receipient);
        return redirect()->back();
    }

    public function acceptFriendRequest($sender)
    {
        $recipient = Auth::user();
        $sender = User::find($sender);
        $recipient->acceptFriendRequest($sender);
        return redirect()->back();
    }

    public function denyRequest($sender)
    {
        $sender = User::find($sender);
        $recipient = Auth::user();
        $recipient->denyFriendRequest($sender);
        return redirect()->back();
    }

    public function unfriend($friend)
    {
        $friend = User::find($friend);
        $user = Auth::user();
        $user->unfriend($friend);
        return redirect()->back();
    }

    public function block($userToBlock)
    {
        $userToBlock = User::find($userToBlock);
        $user = Auth::user();
        if ($user->isFriendWith($userToBlock))
        {
            $this->unfriend($userToBlock);
        }
        $user->blockFriend($userToBlock);
        return redirect()->back();
    }

    public function unblock($userToUnBlock)
    {
        $userToUnBlock = User::find($userToUnBlock);
        $user = Auth::user();
        $user->unblockFriend($userToUnBlock);
        return redirect()->back();
    }
}