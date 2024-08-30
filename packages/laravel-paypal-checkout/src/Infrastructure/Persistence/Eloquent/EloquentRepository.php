<?php

namespace Arneon\LaravelPaypalCheckout\Infrastructure\Persistence\Eloquent;

use Arneon\LaravelPaypalCheckout\Domain\Repositories\Repository as RepositoryInterface;
use Arneon\LaravelPaypalCheckout\Infrastructure\Models\Order;
use Arneon\LaravelPaypalCheckout\Infrastructure\Models\Payment;
use Arneon\LaravelPaypalCheckout\Infrastructure\Services\PaypalService;
use Arneon\LaravelPaypalCheckout\Infrastructure\Helpers\GeneralHelper;

class EloquentRepository implements RepositoryInterface
{
    use GeneralHelper;
    private $paypalService;

    public function __construct(PaypalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    public function savePayment(array $data) : array
    {
        try {
            $model = $this->setEntityValuesToModel(new Payment(), $data);
            $model->save();
            return $model->toArray();

        }catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateOrderStatus(int $order_id)
    {
        $model = new Order();
        $updatedRow = $model
            ->where('id', $order_id)
            ->where('payment_status', 'pending')
            ->update(['payment_status' => 'completed']);

        return $updatedRow ? $model->where('id', $order_id)->first()->toArray() : [];
    }
}
