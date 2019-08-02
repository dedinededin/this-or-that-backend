<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $post_id = $request->post_id;
        $is_this = $request->is_this;

        $user_is_voted = Post::find($post_id)->user_is_voted;
        if (!$user_is_voted) {
            $vote = new Vote();
            $vote->user_id = Auth::user()->id;
            $vote->post_id = $post_id;
            $vote->is_this = $is_this;
            $vote->save();

            return response()->json(Post::find($post_id), 200);
        }
        return response()->json([
            'error' => 'User has vote before!'
        ], 403);
    }
}
