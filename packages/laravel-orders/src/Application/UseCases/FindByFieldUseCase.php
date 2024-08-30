<?php

namespace Arneon\LaravelOrders\Application\UseCases;

use Arneon\LaravelOrders\Domain\Contracts\UseCases\FindByField;
use Arneon\LaravelOrders\Domain\Repositories\Repository as RepositoryInterface;
class FindByFieldUseCase implements FindByField
{
    public function __construct(
        private readonly RepositoryInterface $repository,
    )
    {
    }
    public function __invoke(string $field, mixed $fieldValue): array
    {
        return $this->repository->findByField($field, $fieldValue);
    }


}
