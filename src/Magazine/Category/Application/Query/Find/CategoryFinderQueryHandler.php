<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\Find;

use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class CategoryFinderQueryHandler implements QueryHandler
{
    public function __construct(private CategoryFinder $service)
    {
    }

    public function __invoke(CategoryFinderQuery $query): ?Category
    {
        return $this->service->__invoke(CategoryId::create($query->id()));
    }
}