<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share breadcrumbs with all views if they exist in view data
        View::composer('*', function ($view) {
            if (isset($view->getData()['breadcrumbs'])) {
                View::share('breadcrumbs', $view->getData()['breadcrumbs']);
            }
        });
    }
}
