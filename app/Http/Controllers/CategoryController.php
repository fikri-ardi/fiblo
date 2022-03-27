<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', ['categories' => Category::all()]);
    }

    public function show(Category $category)
    {
        return view('posts.index', [
            'title' => "Post dengan topik $category->name",
            'posts' => $category->posts()->postState(PostStatus::Published)
        ]);
    }
}