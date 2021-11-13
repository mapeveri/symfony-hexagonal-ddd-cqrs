<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Query\GetAll;

use App\Magazine\Portal\Domain\PortalRepository;

final class IndexGetAll
{
    private PortalRepository $repository;

    public function __construct(PortalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->getAll();
    }
}
