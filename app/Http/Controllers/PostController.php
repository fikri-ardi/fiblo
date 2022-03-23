<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\{User, Post};

class PostController extends Controller
{
    public function index()
    {
        $pageTitle = 'Semua Post';
        $pageTitle .= request('category') ? ' di ' . ucwords(str_replace('-', ' ', request('category'))) : '';
        $pageTitle .= request('author') ? ' oleh ' . User::firstWhere('username', request('author')->name) : '';

        return view('posts.index', [
            'pageTitle' => $pageTitle,
            "posts" => Post::filter(request(['search', 'category', 'author']))->exclude(['body', 'updated_at'])->latest()->paginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}