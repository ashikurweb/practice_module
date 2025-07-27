<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionUserController;
use App\Http\Controllers\RegisterUserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(SessionUserController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::post('/logout', 'destroy')->name('logout');
});

Route::controller(RegisterUserController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register', 'store')->name('register.store');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.index');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->name('profile.index');
    Route::post('/profile/update', 'updateProfile')->name('profile.update');
    Route::post('/profile/password', 'updatePassword')->name('profile.password');
});