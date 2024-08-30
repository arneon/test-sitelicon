<?php

namespace Arneon\LaravelPaypalCheckout\Domain\Contracts\UseCases;

interface Create
{
    public function __invoke(array $request): array;
}
