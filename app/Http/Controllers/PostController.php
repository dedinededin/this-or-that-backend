<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all();

        return $data;
    }

    public function show(Post $post)
    {
        $post->user;
        return $post;
    }

    public function store(Request $request)
    {
        $user = auth()->user();

//        $leftFilename = Str::random(10) . ".jpg";
//        $request->file('leftImage')->move(public_path('postImages/'), $leftFilename);
//        $leftImageUrl = url('postImages/' . $leftFilename);
//
//        $rightFilename = Str::random(10) . ".jpg";
//        $request->file('rightImage')->move(public_path('postImages/'), $rightFilename);
//        $rightImageUrl = url('postImages/' . $rightFilename);


        $post = new Post();
        $post->user_id = $user->id;
        $post->left_image = $request->leftImageUrl;
        $post->right_image = $request->rightImageUrl;
        $post->description = $request->description;

        $post->save();
        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function delete(Post $post)
    {
        $post->delete();

        return response()->json($post, 204);
    }

    public function uploadImage(Request $request)
    {
        $filename = Str::random(10) . ".jpg";
        $path = $request->file('photo')->move(public_path('postImages/'), $filename);
        $photoUrl = url('postImages/' . $filename);
        return response()->json(['url' => $photoUrl], 200);
    }
}
