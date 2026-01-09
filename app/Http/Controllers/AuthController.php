<?php

namespace App\Http\Controllers;

use App\Contracts\Auth\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }

    public function refresh(Request $request)
    {
        return $this->authService->refresh($request);
    }

    public function me(Request $request)
    {
        return $this->authService->me($request);
    }
}
