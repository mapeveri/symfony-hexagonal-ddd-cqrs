<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\GetAll;

use App\Magazine\Domain\Bus\Query\QueryHandler;
use App\Magazine\Domain\Category\CategoryRepository;

final class CategoryGetAll
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->getAll();
    }
}
