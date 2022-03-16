<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{ChangePasswordController, LoginController, RegisterController};

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [ChangePasswordController::class, 'update'])->name('password.update');
});