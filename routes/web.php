<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Controllers\SessionUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\MailConfigurationController;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('lang/{locale}', [LocaleController::class, 'switch'])->name('lang.switch');

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionUserController::class, 'index'])->name('login');
    Route::post('/login', [SessionUserController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterUserController::class, 'index'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionUserController::class, 'destroy'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/users', [UsersController::class, 'index'])->name('users');
    });

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    // 在管理路由组中添加以下路由
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // 其他路由...
    
    Route::get('/mail/configuration', [MailConfigurationController::class, 'index'])->name('mail.configuration');
    Route::post('/mail/configuration/update', [MailConfigurationController::class, 'update'])->name('mail.configuration.update');
});

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::post('/password', [UpdatePasswordRequest::class, 'updatePassword'])->name('password');
    });
});

