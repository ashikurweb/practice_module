<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch($locale)
    {
        $availableLocales = ['en', 'bn', 'hi', 'es', 'fr', 'pt', 'de', 'it', 'ru', 'cn', 'ar'];

        if (in_array($locale, $availableLocales)) {
            session(['app_locale' => $locale]);
            app()->setLocale($locale);
        }

        return back();
    }
}
