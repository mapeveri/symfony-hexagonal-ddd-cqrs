<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Delete;

use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\CategoryAssociatedContent;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;

final class CategoryDelete
{
    private CategoryRepository $repository;
    private CategoryFinder $serviceFinder;

    public function __construct(CategoryRepository $repository, CategoryFinder $serviceFinder)
    {
        $this->repository = $repository;
        $this->serviceFinder = $serviceFinder;
    }

    public function __invoke(CategoryId $id): void
    {
        try {
            $category = $this->serviceFinder->__invoke($id);
            $this->repository->delete($category);
        } catch (\Exception $e) {
            throw new CategoryAssociatedContent($id->value());
        }
    }
}
