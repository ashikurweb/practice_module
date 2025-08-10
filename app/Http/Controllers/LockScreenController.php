<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    public function show ()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (session('is_locked')) {
            return view('auth.lockscreen', ['user' => Auth::user()]);
        }

        session(['is_locked' => true]);
        return view('auth.lockscreen', ['user' => Auth::user()]);
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['password' => 'Incorrect password'])
                ->withInput();
        }

        session()->forget('is_locked');
        $request->session()->regenerate();
        
        return redirect()->intended(route('admin.dashboard'));
    }
}
