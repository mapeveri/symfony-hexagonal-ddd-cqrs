<?php

declare(strict_types=1);

namespace App\Magazine\Application\Index\GetAll;

use App\Magazine\Domain\Index\IndexRepository;

final class IndexGetAll
{
    private IndexRepository $repository;

    public function __construct(IndexRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->getAll();
    }
}
