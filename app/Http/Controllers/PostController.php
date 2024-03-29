<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use Illuminate\Http\Request;
use App\Models\{Category, Post};
use App\Http\Requests\PostRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\{Gate, Storage};

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::postState(PostStatus::Published)->filter(request(['search', 'category', 'author']))->exclude(['body', 'updated_at'])->latest()->paginate(7)->withQueryString();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if (request()->cookie('visitor_id') && $post->visitors()->where('visitor_id', request()->cookie('visitor_id'))->first()) {
            return view('posts.show', compact('post'));
        }

        $visitor = auth()->id() ?? str()->uuid();
        Cookie::queue(Cookie::make('visitor_id', $visitor));
        $post->visitors()->create(['visitor_id' => $visitor]);

        return view('posts.show', compact('post'));
    }

    public function create(Request $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        return view('posts.create', ['categories' => Category::all()]);
    }

    public function store(PostRequest $request)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        $request->updateOrInsert();
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil dibuat :)');
    }

    public function edit(Request $request, Post $post)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        Gate::authorize('username', $post->author->username);

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        Gate::authorize('username', $post->author->username);

        $request->updateOrInsert($post);
        return to_route('user_posts.index')->with('message', 'Post kamu berhasil diubah :)');
    }

    public function destroy(Request $request, Post $post)
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return to_route('verification.notice');
        }

        Gate::authorize('username', $post->author->username);

        !$post->image ?: Storage::delete($post->image);
        Post::destroy($post->id);
        return back()->with('message', 'Post kamu berhasil dihapus :)');
    }
}
