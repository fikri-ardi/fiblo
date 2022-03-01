<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use App\Models\{Post, Category};
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', ['posts' => auth()->user()->posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validatedData = $request->all();

        !$request->image ?: $validatedData['image'] = $request->image->store('images/posts');

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');

        auth()->user()->posts()->create($validatedData);
        return redirect('/dashboard/posts')->with(['message' => 'Post kamu berhasil dibuat :)', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $validatedData = $request->all();

        if ($request->image) {
            !$post->image ?: Storage::delete($post->image);
            $validatedData['image'] = $request->image->store('/images/posts');
        }

        $validatedData['user_id'] = auth()->id();
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');

        $post->update($validatedData);
        return redirect('/dashboard/posts')->with(['message' => 'Post kamu berhasil diubah :)', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
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
}