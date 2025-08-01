<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionUserController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication Routes (Login/Logout)
Route::controller(SessionUserController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::post('/logout', 'destroy')->name('logout');
});

// Registration Routes
Route::controller(RegisterUserController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

// Routes that require authentication
Route::middleware('auth')->group(function () {

    // Admin Routes (Requires Authentication)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
    });

    // Profile Routes (Requires Authentication)
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });
});
