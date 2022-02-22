<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            "posts" => Post::latest()->get()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            "post" => $post
        ]);
    }

    public function author(User $user)
    {
        return view('posts.index', [
            "title" => "Post By $user->name",
            "posts" => $user->posts
        ]);
    }
}