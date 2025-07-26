<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('layouts.app', 'layouts.app');
        Blade::component('admin.layouts.admin', 'admin.layouts.admin');
        Blade::component('admin.components.header', 'admin.components.header');
        Blade::component('admin.components.sidebar', 'admin.components.sidebar');
    }
}
