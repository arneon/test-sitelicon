<?php

namespace Arneon\LaravelOrders\Domain\Contracts\UseCases;

interface FindUserPendingOrders
{
    public function __invoke($userId): array;
}
