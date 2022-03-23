<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\PostStatus;
use Illuminate\Support\Str;
use App\Models\{Post, Category};
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Models\Scopes\PublishedScope;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->hasRole('founder') ? Post::withoutGlobalScope(PublishedScope::class)->select('title', 'category_id', 'slug', 'status')->latest()->get() : auth()->user()->posts()->withoutGlobalScope(PublishedScope::class)->select('title', 'category_id', 'slug', 'status')->latest()->get();
        return view('dashboard.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.posts.create', [
            'post' => new Post,
            'categories' => Category::all()
        ]);
    }

    public function store(PostRequest $request)
    {
        $request['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');
        $request['user_id'] = auth()->id();
        Post::create($request->all());
        return redirect('/dashboard/posts')->with(['message' => 'Post kamu berhasil dibuat :)', 'type' => 'success']);
    }

    public function show(Post $post)
    {
        return view('dashboard.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $request['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');
        $request['user_id'] = auth()->id();
        $post->update($request->all());
        return redirect('/dashboard/posts')->with(['message' => 'Post kamu berhasil diubah :)', 'type' => 'success']);
    }

    public function destroy(Post $post)
    {
        !$post->image ?: Storage::delete($post->image);
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with(['message' => 'Post kamu berhasil dihapus :)', 'type' => 'success']);
    }

    public function checkSlug()
    {
        $slug = SlugService::createSlug(Post::class, 'slug', request('title'));
        return response()->json(['slug' => $slug]);
    }

    public function status(PostStatus $status)
    {
        $posts = auth()->user()->hasRole('founder') ? Post::withoutGlobalScope(PublishedScope::class)->select('title', 'category_id', 'slug', 'status')->where('status', $status)->latest()->get() : auth()->user()->posts()->withoutGlobalScope(PublishedScope::class)->select('title', 'category_id', 'slug', 'status')->where('status', $status)->latest()->get();
        return view('dashboard.posts.index', [
            'posts' =>  $posts,
            'status' => $status
        ]);
    }

    public function publish(Post $post)
    {
        $action = $post->status == PostStatus::Draft ? 'publish' : 'unpublish';
        $post->update([
            'status' => $post->status == PostStatus::Draft ? 'published' : 'draft'
        ]);

        return back()->with(['message' => "Post kamu berhasil di$action"]);
    }
}