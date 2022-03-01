<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;

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

Route::get('/posts/categories', [CategoryController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::middleware('auth')->prefix('dashboard')->group(function () {
    // route for check & make a slug
    Route::get('posts/checkSlug', [App\Http\Controllers\Dashboard\PostController::class, 'checkSlug']);

    Route::get('/', DashboardController::class);
    Route::resource('posts', App\Http\Controllers\Dashboard\PostController::class);
});
Route::resource('/dashboard/categories', App\Http\Controllers\Dashboard\CategoryController::class)->middleware(['auth', 'role:admin'])->except('show');