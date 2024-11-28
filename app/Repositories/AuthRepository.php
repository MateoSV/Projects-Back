<?php

namespace App\Repositories;

use App\Interfaces\Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return Auth::user()->createToken('API Token')->plainTextToken;
        }

        return null;
    }

    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }
}