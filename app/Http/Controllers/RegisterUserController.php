<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TokenExpirationService;
use App\Http\Requests\RegisterUserRequest;

class RegisterUserController extends Controller
{
    protected $tokenExpirationService;

    public function __construct(TokenExpirationService $tokenExpirationService)
    {
        $this->tokenExpirationService = $tokenExpirationService;
    }
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = $this->createUser($validated);

        $this->tokenExpirationService->setSessionExpiration(30);

        $this->loginUser($user);
        return redirect()->route('home')->with('success', 'Account created successfully');
    }

    private function createUser(array $validated)
    {
        return User::create($validated);
    }

    private function loginUser(User $user)
    {
        Auth::login($user);
    }
}
