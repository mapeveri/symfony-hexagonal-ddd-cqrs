<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Find;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryFinder as DomainCategoryFinder;
use App\Magazine\Domain\Category\CategoryRepository;

final class CategoryFinder
{
    private DomainCategoryFinder $finder;

    public function __construct(CategoryRepository $repository)
    {
        $this->finder = new DomainCategoryFinder($repository);
    }

    public function __invoke(string $id): Category
    {
        return $this->finder->__invoke($id);
    }
}
