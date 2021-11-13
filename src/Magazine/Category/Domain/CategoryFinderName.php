<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

final class CategoryFinderName
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $name): ?Category
    {
        $category = $this->repository->findByName($name);

        if (null !== $category) {
            throw new CategoryAlreadyExist($name);
        }

        return $category;
    }
}
