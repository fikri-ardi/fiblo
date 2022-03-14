<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $posts = Post::exclude('body')->latest()->limit(6)->get();

        if (auth()->user()) {
            if (auth()->user()->follows->count()) {
                $posts = auth()->user()->followedPost()->exclude('body')->limit(6)->get();
            }
        }

        return view('home', compact('posts'));
    }
}