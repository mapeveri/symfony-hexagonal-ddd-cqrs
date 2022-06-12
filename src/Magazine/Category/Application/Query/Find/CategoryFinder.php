<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\Find;

use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\CategoryFinder as DomainCategoryFinder;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;

final class CategoryFinder
{
    private DomainCategoryFinder $finder;

    public function __construct(CategoryRepository $repository)
    {
        $this->finder = new DomainCategoryFinder($repository);
    }

    public function __invoke(CategoryId $id): Category
    {
        return $this->finder->__invoke($id);
    }
}
