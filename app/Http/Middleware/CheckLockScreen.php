<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLockScreen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Allow access to lockscreen routes always
        if ($request->routeIs('lockscreen') || $request->routeIs('lockscreen.unlock')) {
            return $next($request);
        }

        // If user is locked, redirect to lockscreen
        if (session('is_locked') === true) {
            return redirect()->route('lockscreen');
        }

        return $next($request);
    }
}
