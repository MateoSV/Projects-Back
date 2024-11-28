<?php

namespace App\Interfaces\Auth;

interface AuthServiceInterface
{
    public function login(array $credentials);
    public function logout();
}
