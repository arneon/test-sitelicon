<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Services;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalHttp\HttpException;

class PaypalService {

    private $client;

    public function __construct()
    {
        // Determine the environment (sandbox or production)
        $environment = config('paypal-checkout-config.settings.mode') === 'sandbox'
            ? new SandboxEnvironment(config('paypal-checkout-config.client_id'), config('paypal-checkout-config.secret'))
            : new ProductionEnvironment(config('paypal-checkout-config.client_id'), config('paypal-checkout-config.secret'));

        // Instantiate the PayPal HTTP client
        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder($amount, $currency = 'EUR', $description = null)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => $currency,
                    "value" => number_format($amount, 2)
                ],
                "description" => $description
            ]],
            "application_context" => [
                "cancel_url" => route('cancel'),
                "return_url" => route('success')
            ]
        ];

        try {
            $response = $this->client->execute($request);
            return $response;
        } catch (HttpException $ex) {
            return $ex->getMessage();
        }
    }

    public function captureOrder($orderId)
    {
        $request = new OrdersCaptureRequest($orderId);
        $request->prefer('return=representation');

        try {
            $response = $this->client->execute($request);
            return $response;
        } catch (HttpException $ex) {
            return $ex->getMessage();
        }
    }

}
