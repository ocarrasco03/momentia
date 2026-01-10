<?php

namespace App\Http\Middleware;

use App\Contracts\Auth\TokenService;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckTokenExpiration
{
    public function __construct(protected TokenService $tokenService) {}

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->tokenService->verifyToken($request)) {
            throw new AuthenticationException();
        }

        return $next($request);
    }
}
