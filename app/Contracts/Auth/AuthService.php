<?php

namespace App\Contracts\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface AuthService
{
    public function login(Request $request): JsonResponse;
    public function register(Request $request): JsonResponse;
    public function logout(Request $request): JsonResponse;
    public function refresh(Request $request): JsonResponse;
    public function me(Request $request): JsonResponse;
}
