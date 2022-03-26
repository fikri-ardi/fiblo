<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use Illuminate\Http\Request;
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

    public function create(Request $request)
    {
        if ($request->user()->hasVerifiedEmail() == false) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        return view('posts.create', [
            'post' => new Post(),
            'categories' => Category::all(),
        ]);
    }

    public function store(PostRequest $request)
    {
        if ($request->user()->hasVerifiedEmail() == false) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        $request->insert();
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil dibuat :)');
    }

    public function edit(Request $request, Post $post)
    {
        if ($request->user()->hasVerifiedEmail() == false) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        if ($request->user()->hasVerifiedEmail() == false) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        $request->update($post);
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil diubah :)');
    }

    public function destroy(Request $request, Post $post)
    {
        if ($request->user()->hasVerifiedEmail() == false) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        !$post->image ?: Storage::delete($post->image);
        Post::destroy($post->id);
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil dihapus :)');
    }
}