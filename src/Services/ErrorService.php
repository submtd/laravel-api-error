<?php

namespace Submtd\LaravelApiError\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Submtd\LaravelApiError\Models\Error;

class ErrorService
{
    /**
     * Errors.
     * @var array
     */
    protected $errors = [];

    /**
     * Add error.
     * @param string $message
     * @param int $code
     * @return \Submtd\LaravelApiError\Services\ErrorService
     */
    public function add(string $message, int $code = 0) : self
    {
        $error = Error::create([
            'user_id' => Auth::id(),
            'uri' => request()->url(),
            'request' => request()->all(),
            'request_headers' => request()->headers->all(),
            'message' => $message,
            'code' => $code,
        ]);
        $this->errors[] = $error;

        return $this;
    }

    /**
     * Get errors.
     * @return \Illuminate\Support\Collection
     */
    public function get() : Collection
    {
        return new Collection($this->errors);
    }
}
