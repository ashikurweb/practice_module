<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = ['en', 'bn', 'hi', 'es', 'fr', 'pt', 'de', 'it', 'ru', 'cn', 'ar'];
        
        // Check if locale is set in session
        $locale = session('app_locale');
        
        // If no locale in session, use default
        if (!$locale || !in_array($locale, $availableLocales)) {
            $locale = config('app.locale', 'en');
        }
        
        // Set the application locale
        App::setLocale($locale);
        
        return $next($request);
    }
}
