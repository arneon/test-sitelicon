<?php

namespace Arneon\LaravelOrders\Domain\Contracts\UseCases;

interface Create
{
    public function __invoke(array $request): array;
}
