<?php

namespace Submtd\LaravelApiError\Providers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Submtd\LaravelApiError\Exceptions\Handler;
use Submtd\LaravelApiError\Services\ErrorService;

class ApiErrorServiceProvider extends ServiceProvider
{
    /**
     * Register method.
     */
    public function register()
    {
        // Error service singleton
        $this->app->singleton(ErrorService::class, function () {
            return new ErrorService();
        });
        // Error service facade
        $this->app->bind('error-service', function () {
            return $this->app->make(ErrorService::class);
        });
        // Hijack exception handler
        $appExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->singleton(ExceptionHandler::class, function ($app) use ($appExceptionHandler) {
            return new Handler($app, $appExceptionHandler);
        });
    }
}
