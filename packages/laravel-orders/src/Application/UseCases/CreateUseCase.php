<?php

namespace Arneon\LaravelOrders\Application\UseCases;

use Arneon\LaravelOrders\Domain\Contracts\UseCases\Create as UseCaseInterface;
use Arneon\LaravelOrders\Domain\Repositories\Repository;
class CreateUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly Repository $repository
    ){}

    public function __invoke(array $request): array
    {
        return $this->repository->create($request);
    }
}
