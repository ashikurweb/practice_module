<?php

namespace App\Http\Middleware;

use App\Services\TokenExpirationService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenExpiry
{
    protected $tokenExpirationService;

    public function __construct(TokenExpirationService $tokenExpirationService)
    {
        $this->tokenExpirationService = $tokenExpirationService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $expiryTime = $this->tokenExpirationService->getSessionExpiration();

        if ($expiryTime && now()->gt($expiryTime)) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your session has expired. Please login again.');
        }
        return $next($request);
    }
}
