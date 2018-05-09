<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * @param Request $request
     */
    public function put(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'postContent' => 'required|string|max:255',
            'type' => 'required|in:0,1'
        ]);

        if ($request->type == 0)
        {
            $type = 'CRUMB';
        }
        else
        {
            $type = 'THOUGHT';
        }

        Post::create([
            'user_id' => Auth::id(),
            'content'  => $request->postContent,
            'type' => $type,
            'likes' => 0
        ]);

        return response(true);
    }

    public function update()
    {}

    public function delete()
    {}
}
