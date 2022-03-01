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
        $posts = auth()->user()->posts;

        return view('dashboard.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        if ($request->file('image')) {
            $request['image'] = $request->file('image')->store('images/posts');
        }
        dd($request['image']);

        $request['user_id'] = auth()->id();
        $request['excerpt'] = Str::limit(strip_tags($request['body']), 200, '...');

        Post::create($request->all());
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
        $rules = [
            'title' => 'required|min:3|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required',
        ];

        if (request('slug') != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = request()->validate($rules);

        if (request('image')) {
            !$post->image ?: Storage::delete($post->image);
            $validatedData['image'] = request('image')->store('/images/posts');
        }

        $validatedData['user_id'] = auth()->id();
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body']), 200, '...');

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