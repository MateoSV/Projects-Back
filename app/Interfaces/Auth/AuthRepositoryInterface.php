<?php

namespace App\Interfaces\Auth;

interface AuthRepositoryInterface
{
    public function login(array $credentials);
    public function logout();

    public function getAccessToken($token);
}
