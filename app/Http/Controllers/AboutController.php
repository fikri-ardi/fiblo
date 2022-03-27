<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\PostStatus;
use App\Models\Role;
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
        $user = User::firstWhere('role_id', 1);
        $posts = $user->posts()->postState(PostStatus::Published)->latest()->paginate(6);

        return view('profiles.show', compact('user', 'posts'));
    }
}