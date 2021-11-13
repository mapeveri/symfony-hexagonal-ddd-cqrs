<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\Find;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;

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
