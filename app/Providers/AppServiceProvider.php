<?php

namespace App\Providers;
use App\Services\AfipService;
use App\Services\AfipFeService;
use App\Services\AfipAuthService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(AfipService::class, function () {
        //     return new AfipService();
        // });

        $this->app->bind(AfipAuthService::class, function () {
            return new AfipAuthService();
        });
    
        $this->app->bind(AfipFeService::class, function ($app) {
            return new AfipFeService($app->make(AfipAuthService::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
