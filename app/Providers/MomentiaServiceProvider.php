<?php

namespace App\Providers;

use App\Contracts\Event\EventService;
use Illuminate\Support\ServiceProvider;

class MomentiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $bindings = [
            \App\Services\Event\EventService::class => EventService::class,
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
