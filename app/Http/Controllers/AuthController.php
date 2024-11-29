<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $token = $this->authService->login($credentials);

            if (!$token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $userData = $this->authService->getUserRole();

            return response()->json([
                'user' => $userData,
                'token' => $token,
            ]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $this->authService->logout();
            return response()->json(null, 204);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function validateToken(): JsonResponse
    {
        try {
            $token = request()->bearerToken();
            $valid = $this->authService->validateToken($token);
            return response()->json($valid);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function me(): JsonResponse
    {
        try {
            $userData = $this->authService->getUserRole();
            return response()->json($userData);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
