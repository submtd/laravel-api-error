<?php

namespace Submtd\LaravelApiError\Exceptions;

use App\Exceptions\Handler as ExceptionHandler;
use Submtd\LaravelApiError\Facades\Error;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Render.
     * @param $request
     * @param \Throwable $exception
     */
    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            Error::add($exception);
            $code = Error::code();
            $code = ($code > 99 && $code < 600 ? $code : config('api-error.default_response_code', 299));
            if (config('api.error.always_use_default_response_code', false)) {
                $code = config('api-error.default_response_code', 299);
            }

            return response()->json(['data' => Error::render()], $code);
        }

        return parent::render($request, $exception);
    }
}
