<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Find;

use App\Magazine\Shared\Domain\Bus\Query\Response;
use App\Magazine\Shared\Domain\Bus\Query\QueryHandler;
use App\Magazine\Application\Category\Find\CategoryFinder;
use App\Magazine\Application\Category\Find\CategoryFinderQuery;
use App\Magazine\Application\Category\Find\CategoryFinderResponse;

final class CategoryFinderQueryHandler implements QueryHandler
{
    private CategoryFinder $service;

    public function __construct(CategoryFinder $service)
    {
        $this->service = $service;
    }

    public function __invoke(CategoryFinderQuery $query): Response
    {
        return new CategoryFinderResponse($this->service->__invoke($query->id()));
    }
}
