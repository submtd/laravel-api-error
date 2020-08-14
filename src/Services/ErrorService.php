<?php

namespace Submtd\LaravelApiError\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ErrorService
{
    /**
     * Errors.
     * @var array
     */
    protected $errors = [];

    /**
     * Code.
     * @var int
     */
    protected $code = 0;

    /**
     * Add error.
     * @param \Throwable $exception
     * @return self
     */
    public function add(Throwable $exception) : self
    {
        $this->code = (method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : $exception->getCode());
        $error = [
            'type' => 'error',
            'id' => Str::uuid()->toString(),
            'attributes' => [
                'message' => $exception->getMessage(),
                'code' => $this->code,
                'uri' => request()->getUri(),
                'method' => request()->getMethod(),
                'client_ip' => request()->getClientIp(),
                'request' => request()->all(),
                'request_headers' => request()->headers->all(),
            ],
        ];
        if (config('app.debug', false)) {
            $error['related'] = [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'previous' => $exception->getPrevious(),
                'trace' => $exception->getTrace(),
            ];
        }
        $this->errors[] = $error;
        if (config('api-error.log_errors', true)) {
            $this->log();
        }

        return $this;
    }

    /**
     * Render.
     * @return array
     */
    public function render() : array
    {
        return $this->errors;
    }

    /**
     * Code.
     * @return int
     */
    public function code() : int
    {
        return $this->code;
    }

    /**
     * Log.
     * @return self
     */
    public function log() : self
    {
        $logFile = config('api-error.log_file', 'api-errors');
        config(['logging.channels.'.$logFile => [
            'driver' => 'single',
            'path' => storage_path('logs/'.$logFile.'.log'),
            'level' => 'debug',
        ]]);
        Log::channel($logFile)->debug(json_encode($this->render()));

        return $this;
    }
}
