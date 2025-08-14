<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        parent::boot();

        Route::bind('category', function ($slug) {
            return Category::where('slug', $slug)->firstOrFail();
        });
    }
}
