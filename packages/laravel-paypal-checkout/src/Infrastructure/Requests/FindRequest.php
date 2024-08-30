<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Requests;

use App\Http\Controllers\Controller;
use Arneon\LaravelPaypalCheckout\Domain\Contracts\Requests\FindRequest as RequestInterface;
use Illuminate\Http\Request;

class FindRequest extends Controller implements RequestInterface
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
            ];

            $messages = [
                'order_id.required' => 'OrderId is required',
                'order_id.integer' => 'OrderId should be integer',
                'order_id.exists' => 'OrderId does not exist',
            ];

            return $this->validate($this->request, $rules, $messages);
        }catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}
