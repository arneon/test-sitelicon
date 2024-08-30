<?php

namespace Arneon\LaravelPaypalCheckout\Domain\Contracts\UseCases;

use Arneon\LaravelPaypalCheckout\Domain\Entities\Order;

interface Find
{
    public function __invoke(int $orderId): Order;
}
