<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Delete;

use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\Exceptions\CategoryAssociatedContentException;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;

final class CategoryDelete
{
    public function __construct(private CategoryRepository $repository, private CategoryFinder $serviceFinder)
    {
    }

    public function __invoke(CategoryId $id): void
    {
        try {
            $category = $this->serviceFinder->__invoke($id);
            $this->repository->delete($category);
        } catch (\Exception) {
            throw new CategoryAssociatedContentException($id->value());
        }
    }
}
