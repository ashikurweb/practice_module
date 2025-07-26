<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionUserController extends Controller
{
    /**
     * Show the login form.
     */
    public function index()
    {
        // Redirect if user is already authenticated
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'You are already logged in.');
        }

        return view('auth.login');
    }

    /**
     * Handle user login.
     */
    public function store(SessionUserRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember') && $request->input('remember') == 'on';

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))
                ->with('success', 'Welcome back! You have been successfully logged in.');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle user logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'You have been successfully logged out.');
    }
}
