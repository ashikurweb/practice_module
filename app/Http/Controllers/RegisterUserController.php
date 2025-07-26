<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterUserRequest;

class RegisterUserController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = $this->createUser($validated);
        $this->loginUser($user);
        return redirect()->route('home')->with('success', 'Account created successfully');
    }

    private function createUser(array $validated)
    {
        $user = User::create($validated);
        return $user;
    }

    private function loginUser(User $user)
    {
        Auth::login($user);
    }
}
