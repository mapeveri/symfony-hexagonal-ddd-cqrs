<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

final class CategoryFinder
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?Category
    {
        $category = $this->repository->find($id);

        if (null === $category) {
            throw new CategoryNotExist($id);
        }

        return $category;
    }
}
