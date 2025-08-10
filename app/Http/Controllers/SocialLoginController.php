<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider ( $provider )
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback ( $provider )
    {
        try {
            $user = Socialite::driver($provider)->user();

            $authUser = $this->oauthLogin( $user );
            Auth::login($authUser, true);
        } catch(\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return to_route('admin.dashboard')->with('success', 'Logged in successfully!');
    }

    private function oauthLogin($socialiteUser)
    {
        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $socialiteUser->email],
            [
                'name' => $socialiteUser->name ?: $socialiteUser->nickname,
                'password' => Hash::make(md5(uniqid().now())),
                'email_verified_at' => now()
            ]
        );

        // Save profile image if available and user doesn't have one
        if ($socialiteUser->avatar && !$user->profile_image) {
            try {
                $imageContents = file_get_contents($socialiteUser->avatar);
                
                if ($imageContents !== false) {
                    $filename = 'profile_images/' . uniqid() . '.jpg';
                    Storage::disk('public')->put($filename, $imageContents);
                    
                    $user->profile_image = $filename;
                    $user->save();
                }
            } catch (\Exception $e) {
                Log::error('Failed to download profile image: ' . $e->getMessage());
            }
        }

        return $user;
    }
}
