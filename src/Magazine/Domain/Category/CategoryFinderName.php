<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Category;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryRepository;
use App\Magazine\Domain\Category\CategoryAlreadyExist;

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
