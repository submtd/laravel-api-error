<?php

namespace Submtd\LaravelApiError\Providers;

use Illuminate\Support\ServiceProvider;
use Submtd\LaravelApiError\Services\ErrorService;

class ApiErrorServiceProvider extends ServiceProvider
{
    /**
     * Register method.
     */
    public function register()
    {
        // error service singleton
        $this->app->singleton(ErrorService::class, function () {
            return new ErrorService();
        });
        // error service facade
        $this->app->bind('error-service', function () {
            return $this->app->make(ErrorService::class);
        });
    }
}
