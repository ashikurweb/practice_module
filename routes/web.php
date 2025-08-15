<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\SessionUserController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\MailConfigurationController;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('lang/{locale}', [LocaleController::class, 'switch'])->name('lang.switch');

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionUserController::class, 'index'])->name('login');
    Route::post('/login', [SessionUserController::class, 'store'])->name('login.store');

    Route::get('/forgot', [PasswordResetController::class, 'index'])->name('forgot');
    Route::post('/forgot', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset/{token}', [PasswordResetController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset/{token}', [PasswordResetController::class, 'resetPasswordStore'])->name('reset.password.update');


    Route::get('/register', [RegisterUserController::class, 'index'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

    Route::get('login/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.login');
    Route::get('login/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.callback');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionUserController::class, 'destroy'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [UsersController::class, 'index'])->name('users');
    });

    // Replace the single route with a resource route for categories
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('categories.toggle-status');

    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])
        ->name('blogs.toggle-status');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {    
        Route::get('/mail/configuration', [MailConfigurationController::class, 'index'])->name('mail.configuration');
        Route::post('/mail/configuration/update', [MailConfigurationController::class, 'update'])->name('mail.configuration.update');
    });


    Route::get('lockscreen', [LockScreenController::class, 'show'])->name('lockscreen');
    Route::post('/lockscreen/unlock', [LockScreenController::class, 'unlock'])->name('lockscreen.unlock');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::post('/password', [UpdatePasswordRequest::class, 'updatePassword'])->name('password');
    });
});

