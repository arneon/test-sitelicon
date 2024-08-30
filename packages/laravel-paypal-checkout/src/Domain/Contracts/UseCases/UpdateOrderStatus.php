<?php

namespace Arneon\LaravelPaypalCheckout\Domain\Contracts\UseCases;

interface UpdateOrderStatus
{
    public function __invoke(int $orderId): void;
}
