<?php 

namespace App\Services;

use Illuminate\Support\Facades\Session;

class TokenExpirationService
{
    /**
     * Set the session expiration time based on days.
     *
     * @param int $days
     */
    public function setSessionExpiration(int $days)
    {
        $expiryTime = now()->addDays($days);
        Session::put('token_expiry', $expiryTime);
    }

     /**
     * Get the session expiration time.
     *
     * @return \Carbon\Carbon|null
     */
    public function getSessionExpiration()
    {
        return Session::get('token_expiry');
    }
}