<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about', [
        "name" => "Fikri Ardi",
        "bio" => "An IT enthusiast, hobbies playing guitar, singing, futsal, badminton and love to code",
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

// Route::resource('profiles', ProfileController::class)->middleware('auth')->except(['index', 'create', 'store']);
Route::get('/profiles', [ProfileController::class, 'show'])->middleware('auth');
Route::get('/profiles/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth');
Route::put('/profiles/{user}', [ProfileController::class, 'update'])->middleware('auth');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    // route for check & make a slug
    Route::get('posts/checkSlug', [App\Http\Controllers\Dashboard\PostController::class, 'checkSlug']);

    Route::get('/', DashboardController::class);
    Route::resource('posts', App\Http\Controllers\Dashboard\PostController::class);
});

Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {
    Route::resource('users', App\Http\Controllers\Dashboard\UserController::class)->except('show');
    Route::resource('categories', App\Http\Controllers\Dashboard\CategoryController::class)->except('show');
    Route::resource('roles', App\Http\Controllers\Dashboard\RoleController::class)->except('show');
});