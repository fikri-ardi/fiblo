<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController, LoginController, ProfileController, CategoryController, RegisterController, HomeController};
use App\Models\User;

Route::get('/', HomeController::class)->name('home');
Route::view('/about', 'about', ['founder' => User::whereUsername('fikri')->first()])->name('about');

// categories
Route::get('/posts/categories', [CategoryController::class, 'index'])->name('categories');

// posts
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.single');


// auth
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// profile
Route::middleware('auth')->prefix('profiles')->group(function () {
    Route::get('{user}', [ProfileController::class, 'show'])->name('profiles.show');
    Route::get('{user}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('{user}', [ProfileController::class, 'update'])->name('profiles.update');
});

// posts dashboard
Route::middleware('auth')->prefix('dashboard')->group(function () {
    // route for check & make a slug
    Route::get('posts/checkSlug', [App\Http\Controllers\Dashboard\PostController::class, 'checkSlug']);
    Route::resource('posts', App\Http\Controllers\Dashboard\PostController::class);
    Route::view('/', 'dashboard.index')->name('dashboard.index');
});

// super admin dashboard
Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {
    Route::resource('users', App\Http\Controllers\Dashboard\UserController::class)->except('show');
    Route::resource('categories', App\Http\Controllers\Dashboard\CategoryController::class)->except('show');
    Route::resource('roles', App\Http\Controllers\Dashboard\RoleController::class)->except('show');
});