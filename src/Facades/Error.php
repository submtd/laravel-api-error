<?php

namespace Submtd\LaravelApiError\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Submtd\LaravelApiError\Services\ErrorService add(\Throwable $exception)
 * @method static array render()
 * @method static int code()
 *
 * @see \Submtd\LaravelApiError\Services\ErrorService
 */
class Error extends Facade
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
