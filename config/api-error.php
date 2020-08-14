<?php

return [

    /*
     * Default response code.
     * - This is used if the exception has an invalid http response code
     */
    'default_response_code' => env('API_ERROR_DEFAULT_RESPONSE_CODE', 299),

    /*
     * Always use default response code.
     */
    'always_use_default_response_code' => env('API_ERROR_ALWAYS_USE_DEFAULT_RESPONSE_CODE', false),

    /*
     * Log errors.
     */
    'log_errors' => env('API_ERROR_LOG', true),

    /*
     * Log file.
     */
    'log_file' => env('API_ERROR_LOG_FILE', 'api-errors'),

];
