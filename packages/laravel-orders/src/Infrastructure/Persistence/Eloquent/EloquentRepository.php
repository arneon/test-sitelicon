<?php

namespace Arneon\LaravelOrders\Infrastructure\Persistence\Eloquent;

use Arneon\LaravelOrders\Domain\Repositories\Repository as RepositoryInterface;
use Arneon\LaravelOrders\Infrastructure\Helpers\OrderHelper;
use Arneon\LaravelOrders\Infrastructure\Models\Order as Model;

class EloquentRepository implements RepositoryInterface
{
    use OrderHelper;

    public function findByField(mixed $fieldValue, string $field = 'id')
    {
        try {
            $row = new Model();
            $fields = array_merge($row->getFillable(), ['id']);
            if(!in_array($field, $fields))
            {
                throw new \Exception('Field does not exist');
            }

            $row = $row->where($field, $fieldValue)->first();
            return $row ? $row->toArray() : [];
        }
        catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function create(array $data) : array|\Exception
    {
        try {
            $model = $this->setEntityValuesToModel(new Model(), $data);
            $model->save();
            return $model->toArray();
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function findUserPendingOrders($user_id)
    {
        try {
            $model = new Model();
            $rows = $model
                ->where('user_id', $user_id)
                ->where('payment_status', 'pending')
                ->get();
            return $rows ? $rows->toArray() : [];
        }
        catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}

