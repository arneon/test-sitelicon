<?php

namespace Arneon\LaravelOrders\Application\UseCases;

use Arneon\LaravelOrders\Domain\Contracts\UseCases\FindUserPendingOrders;
use Arneon\LaravelOrders\Domain\Repositories\Repository as RepositoryInterface;
class FindUserPendingOrdersUseCase implements FindUserPendingOrders
{
    public function __construct(
        private readonly RepositoryInterface $repository,
    )
    {
    }
    public function __invoke($userId): array
    {
        return $this->repository->findUserPendingOrders($userId);
    }


}
