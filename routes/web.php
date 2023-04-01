<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\{HomeController, PostController, ProfileController};
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Dashboard\UserController as DashboardUserController;
use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\RoleController as DashboardRoleController;

Route::get('/', HomeController::class)->name('home');

// Posts
Route::resource('posts', PostController::class)->names('user_posts');

// Explore
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

// profile
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
    Route::resource('posts', DashboardPostController::class);
    Route::view('/', 'dashboard.index')->name('dashboard');
});

// Founder's dashboard
Route::middleware(['auth', 'role:founder'])->prefix('dashboard')->group(function () {
    Route::resource('users', DashboardUserController::class)->except('show');
    Route::resource('categories', DashboardCategoryController::class)->except('show');
    Route::resource('roles', DashboardRoleController::class)->except('show');
});

require __DIR__ . '/auth.php';
