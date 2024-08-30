<?php

namespace Arneon\LaravelPaypalCheckout\Domain\Repositories;

interface Repository
{
    public function savePayment(array $data) : array;
    public function updateOrderStatus(int $order_id);
}

