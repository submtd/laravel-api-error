<?php

namespace Submtd\LaravelApiError\Exceptions;

use App\Exceptions\Handler as ExceptionHandler;
use Submtd\LaravelApiError\Facades\Error;
use Submtd\LaravelApiError\Resources\ErrorCollection;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        Error::add($exception->getMessage(), $exception->getCode());
        if ($request->wantsJson()) {
            return new ErrorCollection(Error::get());
        }

        return parent::render($request, $exception);
    }
}
