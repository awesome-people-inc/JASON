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

        $content = strip_tags($request->postContent);

        Post::create([
            'user_id' => Auth::id(),
            'content'  => $content,
            'type' => $type,
            'likes' => 0
        ]);

        return response(array('error' => false, 'msg' => 'Success'));
    }

    public function update()
    {}

    public function delete()
    {}

    public function like(Request $request)
    {
        try
        {
            $validate = Validator::make($request->all(), [
                'id' => 'required|integer'
            ])->validate();

            Post::whereKey($request->id)->increment('likes', 1);

            return response(array('error' => false));
        }
        catch (\Exception $e)
        {
            \Log::error($e->getMessage());
            return response(array('error' => true));
        }
    }
}
