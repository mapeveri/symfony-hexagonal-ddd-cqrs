<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Delete;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryRepository;
use App\Magazine\Application\Category\Find\CategoryFinder;
use App\Magazine\Domain\Category\CategoryAssociatedContent;

final class CategoryDelete
{
    private CategoryRepository $repository;
    private CategoryFinder $serviceFinder;

    public function __construct(CategoryRepository $repository, CategoryFinder $serviceFinder)
    {
        $this->repository = $repository;
        $this->serviceFinder = $serviceFinder;
    }

    public function __invoke(string $id): void
    {
        try {
            $category = $this->serviceFinder->__invoke($id);
            $this->repository->delete($category);
        } catch (\Exception $e) {
            throw new CategoryAssociatedContent($id);
        }
    }
}
