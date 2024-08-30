<?php

namespace Arneon\LaravelOrders\Infrastructure\Requests;

use App\Http\Controllers\Controller;
use Arneon\LaravelOrders\Domain\Contracts\Requests\CreateRequest as RequestInterface;
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
                'user_id' => 'required|integer|exists:users,id',
                'total_amount' => 'required|decimal:1,1',
            ];

            $messages = [
                'user_id.required' => 'UserId is required',
                'user_id.integer' => 'UserId must be numeric',
                'user_id.exists' => 'UserId does not exist',
                'total_amount.required' => 'Amount is required',
                'total_amount.decimal' => 'Amount must be a number',
            ];

            return $this->validate($this->request, $rules, $messages);
        }catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}
