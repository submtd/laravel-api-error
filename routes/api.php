<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api/v1/error',
    'middleware' => 'auth:api',
    'namespace' => 'Submtd\LaravelApiError\Controllers',
], function () {
    Route::get('/', 'ListErrors')->name('api-error.list');
    Route::get('{uuid}', 'ShowError')->name('api-error.show');
});
