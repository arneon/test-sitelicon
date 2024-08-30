<?php

namespace Arneon\LaravelPaypalCheckout\Application\UseCases;

use Arneon\LaravelPaypalCheckout\Domain\Contracts\UseCases\UpdateOrderStatus;
use Arneon\LaravelPaypalCheckout\Domain\Repositories\Repository as RepositoryInterface;
class UpdateOrderStatusUseCase implements UpdateOrderStatus
{
    public function __construct(
        private readonly RepositoryInterface $repository,
    )
    {
    }
    public function __invoke(int $orderId): void
    {
        $this->repository->updateOrderStatus($orderId);
    }


}
