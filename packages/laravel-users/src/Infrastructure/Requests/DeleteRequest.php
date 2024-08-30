<?php

namespace Arneon\LaravelUsers\Infrastructure\Requests;

use App\Http\Controllers\Controller;
use Arneon\LaravelUsers\Domain\Contracts\Requests\DeleteRequest as RequestInterface;
use Illuminate\Http\Request;

class DeleteRequest extends Controller implements RequestInterface
{
    private Request $request;
    public function __construct(mixed $id, Request $request)
    {
        $request->merge(['id' => $id ]);
        $this->request = $request;
    }

    public function __invoke(): array|\Exception
    {
        try {
            $rules = [
                'id' => 'required|integer|exists:users,id',
            ];
            $messages = [
                'id.required' => 'id param is required',
                'id.integer' => 'id param should be integer',
                'id.exists' => 'given id param does not exist',
            ];
            return $this->validate($this->request, $rules, $messages);
        }catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }
}
