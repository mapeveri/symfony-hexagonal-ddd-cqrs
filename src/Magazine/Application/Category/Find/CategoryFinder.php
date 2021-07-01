<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Find;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryFinder as DomainCategoryFinder;
use App\Magazine\Domain\Category\CategoryRepository;

final class CategoryFinder
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->finder = new DomainCategoryFinder($repository);
    }

    public function __invoke(int $id): Category
    {
        return $this->finder->__invoke($id);
    }
}
