<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Registrar middleware
        $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);
    }
}