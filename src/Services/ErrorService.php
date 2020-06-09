<?php

namespace Submtd\LaravelApiError\Services;

class ErrorService
{
    /**
     * Errors.
     * @var array
     */
    protected $errors = [];

    /**
     * Add error.
     * @param string $error.
     */
    public function add(string $error) : self
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * Get errors.
     * @return array
     */
    public function get() : array
    {
        return $this->errors;
    }
}
