<?php

use App\Livewire\Home;
use App\Livewire\Explore;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\{PostController, ProfileController};
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\RoleController as DashboardRoleController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Livewire\DeletePost;
use App\Livewire\EditPost;
use App\Livewire\EditUser;
use App\Livewire\Posts\AllPosts;
use App\Livewire\Posts\CreatePost;
use App\Livewire\Posts\ShowPost;
use App\Livewire\ShowUser;

Route::get('/', Home::class)->name('home');
Route::view('/navbar', 'nav');

// Posts
Route::get('/posts', AllPosts::class)->name('posts.index');
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', CreatePost::class)->name('posts.create');
    Route::get('/posts/{post}/edit', EditPost::class)->name('posts.edit');
    Route::delete('/posts/{post}', DeletePost::class)->name('posts.destroy');
});
Route::get('/posts/{post}', ShowPost::class)->name('posts.show');

// Explore
Route::get('/explore', Explore::class)->name('explore');

// Users
Route::get('/users/{user}', ShowUser::class)->name('users.show');
Route::middleware('auth')->group(function () {
    Route::get('/users/{user}/edit', EditUser::class)->name('users.edit');
});

Route::controller(ProfileController::class)->middleware('auth')->prefix('profiles')->name('profiles.')->group(function () {
    Route::get('{user}', 'show')->name('show')->withoutMiddleware('auth');
    Route::get('{user}/edit', 'edit')->name('edit');
    Route::put('{user}', 'update')->name('update');
    Route::post('{user}/follow', 'follow')->name('follow')->middleware('verified');
});

// Posts dashboard
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    // route for check & make a slug
    Route::get('posts/checkSlug', [PostController::class, 'checkSlug']);
    Route::put('posts/{post}/publish', [DashboardPostController::class, 'publish'])->name('posts.publish');
    Route::get('posts/{status}/status', [DashboardPostController::class, 'status'])->name('posts.status');
    Route::resource('posts', DashboardPostController::class)->names('dashboard');
    Route::get('/', DashboardController::class)->name('dashboard');
});

// Founder's dashboard
Route::middleware(['auth', 'role:founder'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('users', DashboardUserController::class)->except('show');
    Route::resource('categories', DashboardCategoryController::class)->except('show');
    Route::resource('roles', DashboardRoleController::class)->except('show');
});

require __DIR__ . '/auth.php';
