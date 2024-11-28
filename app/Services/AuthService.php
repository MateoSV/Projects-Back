<?php

namespace App\Services;

use App\Interfaces\Auth\AuthServiceInterface;
use App\Repositories\AuthRepository;

class AuthService implements AuthServiceInterface
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function login(array $credentials)
    {
        return $this->authRepository->login($credentials);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}
