<?php
/**
 * Created by PhpStorm.
 * User: Nitish Kumar
 * Date: 5/22/2018
 * Time: 12:56 AM
 */

namespace App\Http\Controllers;


use PhpJunior\LaravelVideoChat\Facades\Chat;

class MessagesController extends Controller
{
 public function index()
 {
     Chat::startConversationWith(1);
     $conversation = Chat::getConversationMessageById(1);
     return view('messages')->with(['conversation' => $conversation]);
 }
}