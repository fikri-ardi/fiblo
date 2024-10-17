<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Enums\PostStatus;

class ExploreController extends Controller
{
    public function index()
    {
        $categories = Category::all();
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

        return view('explore', compact('categories', 'posts', 'photos'));
    }
}