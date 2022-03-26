<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Models\{Category, User, Post};
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $pageTitle = 'Semua Post';
        $pageTitle .= request('category') ? ' di ' . ucwords(str_replace('-', ' ', request('category'))) : '';
        $pageTitle .= request('author') ? ' oleh ' . User::firstWhere('username', request('author')->name) : '';

        return view('posts.index', [
            'pageTitle' => $pageTitle,
            'posts' => Post::postState(PostStatus::Published)->filter(request(['search', 'category', 'author']))->exclude(['body', 'updated_at'])->latest()->paginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create', [
            'post' => new Post(),
            'categories' => Category::all(),
        ]);
    }

    public function store(PostRequest $request)
    {
        $request->insert();
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil dibuat :)');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $request->update($post);
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil diubah :)');
    }

    public function destroy(Post $post)
    {
        !$post->image ?: Storage::delete($post->image);
        Post::destroy($post->id);
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil dihapus :)');
    }
}