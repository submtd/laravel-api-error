<?php

namespace Submtd\LaravelApiError\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Submtd\LaravelApiError\Services\ErrorService add(string $error)
 * @method static array get()
 *
 * @see \Submtd\LaravelApiError\Services\ErrorService
 */
class ErrorFacade extends Facade
{
    /**
     * Get facade accessor.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'error-service';
    }
}
