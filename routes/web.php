<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

// public routes
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile');

// authentication routes (for guests)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// protected routes (for authenticated users)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
