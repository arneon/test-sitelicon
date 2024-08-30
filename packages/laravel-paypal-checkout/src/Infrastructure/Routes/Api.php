<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Arneon\LaravelPaypalCheckout\Infrastructure\Controllers\PaypalController as Controller;

Route::group(['middleware' => [
    'web',
    'middleware' => 'auth:sanctum',
]], function () {
    Route::get('/checkout/create', [Controller::class, 'createPayment'])->name('paypal.create');
    Route::get('/checkout/callback', [Controller::class, 'executePayment'])->name('paypal.callback');
    Route::get('/checkout/cancel', [Controller::class, 'cancelPayment'])->name('paypal.cancel');
});
