<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
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
        $posts =  Post::exclude('body', 'status', 'updated_at')->postState(PostStatus::Published)->latest()->limit(6)->get();

        if (auth()->user() && auth()->user()->follows->count()) {
            $posts = auth()->user()->followedPost()->exclude('body', 'status', 'updated_at')->postState(PostStatus::Published)->latest()->limit(6)->get();
        }

        return view('home', compact('posts'));
    }
}
