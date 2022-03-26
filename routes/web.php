<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AboutController, HomeController, PostController, ProfileController, CategoryController};

Route::get('/', HomeController::class)->name('home');
Route::get('/about', AboutController::class)->name('about');

// categories
Route::get('/posts/categories', [CategoryController::class, 'index'])->name('categories');

// posts
Route::resource('posts', PostController::class)->names('user_posts');

// profile
Route::controller(ProfileController::class)->middleware('auth')->prefix('profiles')->name('profiles.')->group(function () {
    Route::get('{user}', 'show')->name('show')->withoutMiddleware('auth');
    Route::get('{user}/edit', 'edit')->name('edit');
    Route::put('{user}', 'update')->name('update');
    Route::post('{user}/follow', 'follow')->name('follow')->middleware('verified');
});

// posts dashboard
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    // route for check & make a slug
    Route::get('posts/checkSlug', [App\Http\Controllers\Dashboard\PostController::class, 'checkSlug']);
    Route::put('posts/{post}/publish', [App\Http\Controllers\Dashboard\PostController::class, 'publish'])->name('posts.publish');
    Route::get('posts/{status}/status', [App\Http\Controllers\Dashboard\PostController::class, 'status'])->name('posts.status');
    Route::resource('posts', App\Http\Controllers\Dashboard\PostController::class);
    Route::view('/', 'dashboard.index')->name('dashboard');
});


// founder dashboard
Route::middleware(['auth', 'role:founder'])->prefix('dashboard')->group(function () {
    Route::resource('users', App\Http\Controllers\Dashboard\UserController::class)->except('show');
    Route::resource('categories', App\Http\Controllers\Dashboard\CategoryController::class)->except('show');
    Route::resource('roles', App\Http\Controllers\Dashboard\RoleController::class)->except('show');
});

require __DIR__ . '/auth.php';