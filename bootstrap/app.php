<?php

use App\Http\Middleware\CheckTokenExpiration;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'check.token.expiration' => CheckTokenExpiration::class,
            'force.json'             => ForceJsonResponse::class,
        ]);

        $middleware->group('api', [
            'force.json',
            'check.token.expiration',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        });

        $exceptions->render(function (AuthorizationException | AccessDeniedHttpException $e, $request) {
            return response()->json([
                'message' => 'You cannot perform this actions.',
                'error'   => $e->getMessage()
            ], 403);
        });

        $exceptions->render(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'message' => 'The requested page does not exist.',
            ], 404);
        });
    })->create();
