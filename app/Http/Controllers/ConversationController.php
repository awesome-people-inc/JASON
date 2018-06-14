<?php

namespace App\Http\Controllers;

use App\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function sendMsg(Request $request)
    {
        $id = $request->id;
        Conversation::create([
            'first_user' => \Auth::id(),
            'second_user' => (int)$id,
            'content' => $request->message
        ]);
        return true;
    }
}
