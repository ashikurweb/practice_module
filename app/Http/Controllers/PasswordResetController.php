<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Show the password reset request form.
     */
    public function index()
    {
        return view('auth.forgot');
    }

    /**
     * Send the password reset link to the user's email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $request->validate(['email' => 'required|email']);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // If user doesn't exist, return error message
        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        // Generate a random token for the reset link
        $user->remember_token = Str::random(50);
        $user->save();

        // Send the reset password email
        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'There was an error sending the password reset email. Please try again later.']);
        }

        return back()->with('success', 'We have emailed your password reset link!');
    }

    /**
     * Show the password reset form with the token.
     */
    public function resetPassword($token)
    {
        // Find the user based on the reset token
        $user = User::where('remember_token', $token)->first();

        // If no user found, return error
        if (!$user) {
            return redirect()->route('login')->withErrors(['token' => 'This password reset link is invalid or expired.']);
        }

        return view('auth.reset-password', compact('user', 'token'));
    }

    /**
     * Update the user's password.
     */
    public function resetPasswordStore(Request $request, $token)
    {
        // Validate the new password
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        // Find the user based on the reset token
        $user = User::where('remember_token', $token)->first();

        // If no user found or the token is invalid, return an error
        if (!$user) {
            return redirect()->route('login')->withErrors(['token' => 'This password reset link is invalid or expired.']);
        }

        // Update the user's password and clear the reset token
        $user->password = Hash::make($request->password);
        $user->remember_token = null;  // Clear the token after password reset
        $user->save();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully. You can now log in.');
    }
}
