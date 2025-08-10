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
        Blade::component('layouts.guest', 'layouts.guest');
        Blade::component('layouts.auth', 'layouts.auth');
        Blade::component('components.header', 'components.header');
        Blade::component('components.sidebar', 'components.sidebar');
        Blade::component('components.theme-toggle', 'components.theme-toggle');
        Blade::component('components.notification', 'notification');
        Blade::component('components.breadcrumb', 'breadcrumb');
    }
}
