<?php
/**
 * Created by PhpStorm.
 * User: Nitish Kumar
 * Date: 5/22/2018
 * Time: 12:56 AM
 */

namespace App\Http\Controllers;


class MessagesController extends Controller
{
 public function index()
 {
     return view('messages');
 }
}