<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain\Services;

use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\Exceptions\CategoryNotExistException;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;

final class CategoryFinder
{
    public function __construct(private CategoryRepository $repository)
    {
    }

    public function __invoke(CategoryId $id): ?Category
    {
        $category = $this->repository->find($id);

        if (null === $category) {
            throw new CategoryNotExistException($id->value());
        }

        return $category;
    }
}
