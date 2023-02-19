<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\Find;

use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;

final class CategoryFinderResponseQueryHandler implements QueryHandler
{
    public function __construct(private CategoryFinder $service)
    {
    }

    public function __invoke(CategoryFinderResponseQuery $query): Response
    {
        $category = $this->service->__invoke(CategoryId::create($query->id()));
        return new CategoryFinderResponse(
            $category->id()->value(),
            $category->name(),
            $category->description(),
            $category->parent()?->id()?->value(),
            $category->hidden()
        );
    }
}
