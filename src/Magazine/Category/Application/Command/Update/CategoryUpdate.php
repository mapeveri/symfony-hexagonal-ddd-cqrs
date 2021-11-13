<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Update;

use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\CategoryRepository;

final class CategoryUpdate
{
    private CategoryRepository $repository;
    private CategoryFinder $serviceFinder;

    public function __construct(CategoryRepository $repository, CategoryFinder $serviceFinder)
    {
        $this->repository = $repository;
        $this->serviceFinder = $serviceFinder;
    }

    public function __invoke(string $id, string $name, string $description, ?string $parent, ?bool $hidden): void
    {
        $category = $this->serviceFinder->__invoke($id);
        $parentCategory = ($parent ? $this->serviceFinder->__invoke($parent) : null);
        
        $category->rename($name);
        $category->setDescription($description);
        $category->setHidden($hidden);
        $category->setParent($parentCategory);

        $this->repository->save($category);
    }
}
