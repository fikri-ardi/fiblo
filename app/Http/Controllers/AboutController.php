<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = User::where('role_id', 1)->first();
        $posts = $user->posts()->postState(\App\Enums\PostStatus::Published)->latest()->paginate(6);
        return view('profiles.show', compact('user', 'posts'));
    }
}