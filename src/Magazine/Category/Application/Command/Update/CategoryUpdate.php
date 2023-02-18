<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Update;

use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;

final class CategoryUpdate
{
    public function __construct(private CategoryRepository $repository, private CategoryFinder $serviceFinder)
    {
    }

    public function __invoke(CategoryId $id, string $name, string $description, ?CategoryId $parent, ?bool $hidden): void
    {
        $category = $this->serviceFinder->__invoke($id);
        $parentCategory = ($parent ? $this->serviceFinder->__invoke($parent) : null);
        
        $category->update($name, $description, $parentCategory, $hidden);
        $this->repository->save($category);
    }
}
