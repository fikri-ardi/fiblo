<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $pageTitle = 'Semua Post';
        $pageTitle .= request('category') ? ' di ' . ucwords(str_replace('-', ' ', request('category'))) : '';
        $pageTitle .= request('author') ? ' oleh ' . User::firstWhere('username', request('author'))->name : '';

        return view('posts.index', [
            'pageTitle' => $pageTitle,
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
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