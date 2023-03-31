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

        return view('explore', compact('categories', 'posts'));
    }
}
