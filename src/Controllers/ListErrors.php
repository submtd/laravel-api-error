<?php

namespace Submtd\LaravelApiError\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiError\Models\Error;
use Submtd\LaravelApiError\Resources\ErrorCollection;

class ListErrors extends Controller
{
    /**
     * Invoke.
     * @param \Illuminate\Http\Request $request
     * @return \Submtd\LaravelApiError\Resources\ApiErrorCollection
     */
    public function __invoke(Request $request)
    {
        $limit = $request->get('limit') ?? config('api-error.error_limit', 50);
        $offset = $request->get('offset') ?? 0;
        $errors = Error::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->offset($offset)
            ->get();

        return new ErrorCollection($errors);
    }
}
