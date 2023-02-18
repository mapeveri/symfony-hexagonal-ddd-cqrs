<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain\Services;

use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\Exceptions\CategoryAlreadyExistException;

class CategoryFinderByNameChecker
{
    public function __construct(private CategoryRepository $repository)
    {
    }

    public function __invoke(string $name): void
    {
        $category = $this->repository->findByName($name);

        if (null !== $category) {
            throw new CategoryAlreadyExistException($name);
        }
    }
}
