<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Category;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryNotExist;
use App\Magazine\Domain\Category\CategoryRepository;

final class CategoryFinder
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Category
    {
        $category = $this->repository->find($id);

        if (null === $category) {
            throw new CategoryNotExist($id);
        }

        return $category;
    }
}
