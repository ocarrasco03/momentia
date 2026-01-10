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
        $this->tokenService->revokeToken($request->user());
        return $this->success(null, 'You have been logged out.');
    }

    public function refresh(Request $request): JsonResponse
    {
        $this->tokenService->revokeToken($request->user());

        return $this->success(
            $this->tokenService->generateToken($request->user()),
            'Token successfully refreshed.'
        );
    }

    public function register(Request $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return $this->success(
            $this->tokenService->generateToken($user),
            'User registered successfully.'
        );
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return $this->success($user);
    }
}
