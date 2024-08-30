<?php

namespace Arneon\LaravelPaypalCheckout\Application\UseCases;

use Arneon\LaravelPaypalCheckout\Domain\Contracts\UseCases\Create as UseCaseInterface;
use Arneon\LaravelPaypalCheckout\Domain\Repositories\Repository;
class CreateUseCase implements UseCaseInterface
{
    public function __construct(
        private readonly Repository $repository
    ){}

    public function __invoke(array $request): array
    {
        return $this->repository->savePayment($request);
    }
}
