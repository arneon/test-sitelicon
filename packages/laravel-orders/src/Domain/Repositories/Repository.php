<?php

namespace Arneon\LaravelOrders\Domain\Repositories;

interface Repository
{
    public function create(array $data);
    public function findUserPendingOrders(int $user_id);
}

