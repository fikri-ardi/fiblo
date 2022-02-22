<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about', [
        "name" => "Fikri Ardi",
        "email" => "fikriardi@gmail.com",
        "image" => "fikri",
    ]);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/author/{user:username}', [PostController::class, 'author']);

Route::get('/posts/categories', [CategoryController::class, 'index']);
Route::get('/posts/categories/{category:slug}', [CategoryController::class, 'show']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);