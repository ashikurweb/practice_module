<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLockScreen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply to authenticated users
        if (!Auth::check()) {
            return $next($request);
        }

        // Allow access to lockscreen routes always
        if ($request->routeIs('lockscreen') || $request->routeIs('lockscreen.unlock')) {
            return $next($request);
        }

        // If user is locked, redirect to lockscreen
        if (session('is_locked', false) === true) {
            // Store intended URL for redirect after unlock
            if (!$request->is('lockscreen*') && !$request->is('unlock')) {
                session()->put('url.intended', $request->fullUrl());
            }
            
            return redirect()->route('lockscreen');
        }

        return $next($request);
    }
}