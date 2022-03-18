<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController, ProfileController, CategoryController, RegisterController, HomeController};
use App\Models\User;

Route::middleware('cache.response')->group(function () {
    Route::get('/', HomeController::class)->name('home')->withoutMiddleware('cache.response');
    Route::view('/about', 'profiles.show', ['user' => User::where('role_id', 1)->first()])->name('about');

    // categories
    Route::get('/posts/categories', [CategoryController::class, 'index'])->name('categories');

    // posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.single');

    // profile
    Route::middleware('auth')->prefix('profiles')->group(function () {
        Route::get('{user}', [ProfileController::class, 'show'])->name('profiles.show')->withoutMiddleware('auth');
        Route::get('{user}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::put('{user}', [ProfileController::class, 'update'])->name('profiles.update');

        Route::post('{user}/follow', [ProfileController::class, 'follow'])->name('profiles.follow');
    });
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

require 'auth.php';