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
        session(['is_locked' => true]);
        return view('auth.lockscreen', ['user' => Auth::user()]);
    }

     public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (Hash::check($request->password, $user->password)) {
            session()->forget('is_locked');

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Incorrect password']);
    }
}
