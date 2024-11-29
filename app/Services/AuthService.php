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

    public function getUserRole(): array
    {
        $user = Auth()->user();
        $permissionNames = $user->getAllPermissions();;
        $roles = $user->getRoleNames();

        return [
            ...$user->toArray(),
            'permissions' => $permissionNames,
            'roles' => $roles,
        ];
    }

    public function validateToken($token): bool
    {
        if (!$token) {
            return false;
        }

        $accessToken = $this->authRepository->getAccessToken($token);

        if (!$accessToken) {
            return false;
        }
        return true;
    }

    public function getAllUsers()
    {
        return $this->authRepository->getAllUsers();
    }
}
