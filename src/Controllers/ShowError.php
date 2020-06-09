<?php

namespace Submtd\LaravelApiError\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiError\Models\Error;
use Submtd\LaravelApiError\Resources\ErrorResource;

class ShowError extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @param string $uuid
     * @return \Submtd\LaravelApiError\Resources\ApiErrorCollection
     */
    public function __invoke(Request $request, string $uuid)
    {
        if (! $error = Error::where('user_id', Auth::id())->where('uuid', $uuid)->first()) {
            throw new Exception('Unknown error', 404);
        }

        return new ErrorResource($error);
    }
}
