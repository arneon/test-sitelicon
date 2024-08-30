<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Controllers;

use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\LiveEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

use Arneon\LaravelPaypalCheckout\Application\UseCases\UpdateOrderStatusUseCase;
use Arneon\LaravelPaypalCheckout\Application\UseCases\CreateUseCase;

class PaypalController
{
    public function __construct(
        private readonly UpdateOrderStatusUseCase $updateOrderStatusUseCase,
        private readonly CreateUseCase $createUseCase,
    )
    {
        $environment = config('paypal-checkout-config.settings.mode') === 'sandbox'
            ? new SandboxEnvironment(config('paypal-checkout-config.client_id'), config('paypal-checkout-config.secret'))
            : new LiveEnvironment(config('paypal-checkout-config.client_id'), config('paypal-checkout-config.secret'));
        $this->client = new PayPalHttpClient($environment);
    }


    public function createPayment(Request $request)
    {
        $params = $request->all();

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $params['orderId'],
                    'amount' => [
                        'currency_code' => $params['currency'],
                        'value' => $params['amount'],
                    ],
                ],
            ],

            'application_context' => [
                'return_url' => route('paypal.callback'),
                'cancel_url' => route('paypal.cancel'),
            ],
        ];

        try {
            $response = $this->client->execute($request);
            $approvalUrl = collect($response->result->links)
                ->firstWhere('rel', 'approve')
                ->href;

            request()->session()->put(['order_id' => $params['orderId']]);

            return redirect()->away($approvalUrl);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function executePayment(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $orderToken = $request->query('token');
        $request = new OrdersCaptureRequest($orderToken);

        try {
            $response = $this->client->execute($request);
            $orderId = $response->result->purchase_units[0]->reference_id;

            $paymentArray = [
                'order_id' => $orderId,
                'payment_id' => $response->result->id,
                'payer_id' => $response->result->payer->payer_id,
                'payer_email' => $response->result->payer->email_address,
                'amount' => $response->result->purchase_units[0]->payments->captures[0]->amount->value,
                'currency' => $response->result->purchase_units[0]->payments->captures[0]->amount->currency_code,
                'payment_status' => $response->result->status,
            ];

            $newPayment = $this->createUseCase->__invoke($paymentArray);
            $this->updateOrderStatusUseCase->__invoke($orderId);

            $url = env('SERVER_FQDN').'/api/orders/user/'.$userId.'/pending';
            return redirect()->away($url);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cancelPayment()
    {
        $url = env('SERVER_FQDN').'/api/orders/user/'.request()->session()->get('user_id').'/pending';
        return redirect()->away($url);
    }
}
