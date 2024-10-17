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

        // Use unsplash API
        // Configuration
        \Unsplash\HttpClient::init([
            'applicationId'    => 'PTLofgTCyG3DdSy0VlHNnc3J1XvwMFQqoFvorI0yk94',
            'secret'    => 'goVuwhRJCkSK7WJU8OSESmXB0lHulCxy5wTaNqweSXs',
            'callbackUrl'    => 'http://fiblo.test/',
            'utmSource' => 'Fiblo'
        ]);

        // Get some random photos
        $photos = \Unsplash\Photo::random(['query' => 'moutain'])->urls['regular'];

        return view('posts.index', compact(['posts', 'photos']));
    }

    public function show(Post $post)
    {
        // Use unsplash API
        // Configuration
        \Unsplash\HttpClient::init([
            'applicationId'    => 'PTLofgTCyG3DdSy0VlHNnc3J1XvwMFQqoFvorI0yk94',
            'secret'    => 'goVuwhRJCkSK7WJU8OSESmXB0lHulCxy5wTaNqweSXs',
            'callbackUrl'    => 'http://fiblo.test/',
            'utmSource' => 'Fiblo'
        ]);

        // Get some random photos
        $photos = \Unsplash\Photo::random(['query' => 'moutain'])->urls['regular'];

        // Jika ada cookie yang berisi id user yang saat ini sedang login, maka jangan tambah data views, langsung
        // tampilkan halaman show post
        if (request()->cookie('visitor_id') && $post->visitors()->where('visitor_id', request()->cookie('visitor_id'))->first()) {
            return view('posts.show', compact(['post', 'photos']));
        }

        // Buat variabel & cookie visitor yang berisi id user yang sedang login atau katakter uniq jika user belum login
        $visitor = auth()->id() ?? str()->uuid();
        Cookie::queue(Cookie::make('visitor_id', $visitor));
        $post->visitors()->create(['visitor_id' => $visitor]);

        return view('posts.show', compact(['post', 'photos']));
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