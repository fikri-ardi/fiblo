<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController, LoginController, ProfileController, CategoryController, RegisterController, HomeController};
use App\Http\Controllers\Dashboard\DashboardController;
use App\Models\User;

Route::get('/', HomeController::class);
Route::view('/about', 'about', ['founder' => User::whereUsername('fikri')->first()]);

// categories
Route::get('/posts/categories', [CategoryController::class, 'index']);

// posts
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);


// auth
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// profile
Route::get('/profiles', [ProfileController::class, 'show'])->middleware('auth');
Route::get('/profiles/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth');
Route::put('/profiles/{user}', [ProfileController::class, 'update'])->middleware('auth');

// posts dashboard
Route::middleware('auth')->prefix('dashboard')->group(function () {
    // route for check & make a slug
    Route::get('posts/checkSlug', [App\Http\Controllers\Dashboard\PostController::class, 'checkSlug']);

    Route::get('/', DashboardController::class);
    Route::resource('posts', App\Http\Controllers\Dashboard\PostController::class);
});

// super admin dashboard
Route::middleware(['auth', 'role:admin'])->prefix('dashboard')->group(function () {
    Route::resource('users', App\Http\Controllers\Dashboard\UserController::class)->except('show');
    Route::resource('categories', App\Http\Controllers\Dashboard\CategoryController::class)->except('show');
    Route::resource('roles', App\Http\Controllers\Dashboard\RoleController::class)->except('show');
});