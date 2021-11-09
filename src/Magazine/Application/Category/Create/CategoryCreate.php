<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Create;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryFinderName;
use App\Magazine\Domain\Category\CategoryRepository;
use App\Magazine\Application\Category\Find\CategoryFinder;
use App\Magazine\Shared\Domain\Uuid;

final class CategoryCreate
{
    private CategoryRepository $repository;
    private CategoryFinder $serviceFinder;
    private CategoryFinderName $serviceFinderName;

    public function __construct(
        CategoryRepository $repository,
        CategoryFinder $serviceFinder,
        CategoryFinderName $serviceFinderName
    ) {
        $this->repository = $repository;
        $this->serviceFinder = $serviceFinder;
        $this->serviceFinderName = $serviceFinderName;
    }

    public function __invoke(string $name, string $description, ?int $parent, bool $hidden): void
    {
        // Throw exception if the category exists
        $this->serviceFinderName->__invoke($name);

        $parentCategory = ($parent ? $this->serviceFinder->__invoke($parent) : null);
        $category = Category::create(
            Uuid::next(),
            $name,
            $description,
            $parentCategory,
            $hidden
        );

        $this->repository->save($category);
    }
}
