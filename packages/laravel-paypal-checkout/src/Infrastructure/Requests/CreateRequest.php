<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Requests;

use App\Http\Controllers\Controller;
use Arneon\LaravelPaypalCheckout\Domain\Contracts\Requests\CreateRequest as RequestInterface;
use Illuminate\Http\Request;

class CreateRequest extends Controller implements RequestInterface
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke(): array|\Exception
    {
        try {
            $rules = [
                'order_id' => 'required|integer|exists:orders,id',
                'amount' => 'required|float',
                'currency' => 'required|string|in:EUR,USD',
            ];

            $messages = [
                'order_id.required' => 'OrderId is required',
                'order_id.integer' => 'OrderId should be integer',
                'order_id.exists' => 'OrderId dose not exists',
                'amount.required' => 'Amount is required',
                'amount.float' => 'Amount should be a number',
                'currency.required' => 'Currency is required',
                'currency.in' => 'Currency should be EUR or USD',
            ];

            return $this->validate($this->request, $rules, $messages);
        }catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}
