<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EggController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

// public routes
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/eggs', [EggController::class, 'overview'])->name('eggs.index');
Route::get('/eggs/{nest}/{egg}', [EggController::class, 'show'])->name('eggs.show');
Route::get('/eggs/{nest}/{egg}/download', [EggController::class, 'download'])->name('eggs.download');
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
