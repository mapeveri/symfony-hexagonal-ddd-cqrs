<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

class CategoryFinderName
{
    public function __construct(private CategoryRepository $repository)
    {
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
