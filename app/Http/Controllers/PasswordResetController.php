<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.forgot');
    }

    public function sendResetLinkEmail( Request $request )
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->firstOrFail();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        $user->remember_token = Str::random(50);
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordMail($user));
        return back()->with('success', 'We have emailed your password reset link!');
    }

    public function resetPassword($token)
    {
        $user = User::where('remember_token', $token)->first();
        return view('auth.reset-password', compact('user', 'token'));
    }
}
