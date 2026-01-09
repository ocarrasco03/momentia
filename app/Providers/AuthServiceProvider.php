<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\TokenService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $bindings = [
            \App\Contracts\Auth\AuthService::class => AuthService::class,
            \App\Contracts\Auth\TokenService::class => TokenService::class,

        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
