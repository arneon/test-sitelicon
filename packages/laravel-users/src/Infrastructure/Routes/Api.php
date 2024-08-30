<?php

namespace Arneon\LaravelUsers\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Arneon\LaravelUsers\Infrastructure\Controllers\UserController as Controller;

Route::group([
    'prefix' => 'api/users',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('{value}/{field}', [Controller::class, 'findByField']);
    Route::post('', [Controller::class, 'create']);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('api/users/login', [Controller::class, 'loginForm'])->name('login');
    Route::post('api/users/login', [Controller::class, 'login']);
});

Route::post('api/users/register', [Controller::class, 'register']);

