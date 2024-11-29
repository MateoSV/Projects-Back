<?php

namespace App\Repositories;

use App\Interfaces\Auth\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

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

    public function getAccessToken($token)
    {
        return PersonalAccessToken::findToken($token);
    }

    public function getAllUsers()
    {
        return User::all();
    }
}
