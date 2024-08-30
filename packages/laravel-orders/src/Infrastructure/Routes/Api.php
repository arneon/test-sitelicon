<?php

namespace Arneon\LaravelOrders\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Arneon\LaravelOrders\Infrastructure\Controllers\OrderController as Controller;

Route::group([
    'prefix' => 'api/orders',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('{value}/{field}', [Controller::class, 'findByField']);
    Route::post('', [Controller::class, 'create']);

});

Route::group(['middleware' => [
    'web',
    'middleware' => 'auth:sanctum',
]], function () {
    Route::get('api/orders/user/{userId}/pending', [Controller::class, 'findPendingOrders']);
});
