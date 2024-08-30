<?php

namespace Arneon\LaravelOrders\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Arneon\LaravelOrders\Application\UseCases\CreateUseCase;
use Arneon\LaravelOrders\Infrastructure\Requests\CreateRequest;
use Arneon\LaravelOrders\Application\UseCases\FindByFieldUseCase;
use Arneon\LaravelOrders\Application\UseCases\FindUserPendingOrdersUseCase;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController
{
    public function __construct(
        private readonly CreateUseCase $createUseCase,
        private readonly FindByFieldUseCase $findByFieldUseCase,
        private readonly FindUserPendingOrdersUseCase $findUserPendingOrdersUseCase,
    )
    {
    }

    public function create(Request $request) : JsonResponse
    {
        try{
            $createRequest = new CreateRequest($request);
            $validatedData = $createRequest->__invoke();
        }
        catch (\Exception $e){
            return response()->json(['errors' => ['message' => $e->getMessage()]], 400);
        }

        try {
            return response()->json(['data' => $this->createUseCase->__invoke($validatedData)]);
        }catch (\Exception $e)
        {
            return response()->json(['errors' => ['message' => $e->getMessage()]], 500);
        }
    }
    public function findByField(mixed $fieldValue, string $field) : JsonResponse
    {
        try {
            return response()->json(['data' => $this->findByFieldUseCase->__invoke($fieldValue, $field)]);
        }catch (\Exception $e){
            return response()->json(['errors' => ['message' => $e->getMessage()]], 400);
        }
    }

    public function findPendingOrders($userId) : JsonResponse|View
    {
        try {
            $orders = $this->findUserPendingOrdersUseCase->__invoke($userId);
            return view('arneon/laravel-orders::pendingOrders', ['orders' => $orders]);
        }catch (\Exception $e){
            return response()->json(['errors' => ['message' => $e->getMessage()]], 400);
        }
    }
}
