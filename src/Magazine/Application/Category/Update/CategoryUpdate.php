<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Update;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryRepository;
use App\Magazine\Application\Category\Find\CategoryFinder;

final class CategoryUpdate
{
    private CategoryRepository $repository;
    private CategoryFinder $serviceFinder;

    public function __construct(CategoryRepository $repository, CategoryFinder $serviceFinder)
    {
        $this->repository = $repository;
        $this->serviceFinder = $serviceFinder;
    }

    public function __invoke(int $id, string $name, string $description, ?int $parent, ?bool $hidden): void
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
