<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\GetAll;

use App\Magazine\Category\Domain\CategoryRepository;

final class CategoryGetAll
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->getAll();
    }
}
