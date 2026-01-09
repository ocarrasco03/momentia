<?php

namespace App\Services\Auth;

use \App\Contracts\Auth\AuthService as AuthServiceContract;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceContract
{
    use ApiResponse;

    public function __construct(protected TokenService $tokenService) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $request->validated();

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $activeSessions = $user->tokens()->count();
        $maxSessions = config('auth.max_sessions', 5);

        if ($activeSessions >= $maxSessions) {
            $user->tokens()->oldest()->first()->delete();
        }

        return $this->success($this->tokenService->generateToken($user));
    }

    public function logout(Request $request): JsonResponse
    {
        if (!$request->user()) {
            return response()->json([]);
        }

        $this->tokenService->revokeToken($request->user());
        return $this->success(null, 'You have been logged out.');
    }

    public function refresh(Request $request): JsonResponse
    {
        // TODO: Implement refresh() method.
    }

    public function register(Request $request): JsonResponse
    {
        // TODO: Implement register() method.
    }

    public function me(Request $request): JsonResponse
    {
        // TODO: Implement me() method.
    }
}
