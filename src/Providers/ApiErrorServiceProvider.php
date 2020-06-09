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
        // error service singleton
        $this->app->singleton(ErrorService::class, function () {
            return new ErrorService();
        });
        // error service facade
        $this->app->bind('error-service', function () {
            return $this->app->make(ErrorService::class);
        });
        // hijack exception handler
        $appExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this->app->singleton(ExceptionHandler::class, function ($app) use ($appExceptionHandler) {
            return new Handler($app, $appExceptionHandler);
        });
    }

    /**
     * Boot method.
     */
    public function boot()
    {
        // config
        $this->mergeConfigFrom(__DIR__.'/../../config/api-error.php', 'api-error');
        $this->publishes([__DIR__.'/../../config' => config_path()], 'config');
        // migrations
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([__DIR__.'/../../database' => database_path()], 'migrations');
        // routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
    }
}
