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
        return new CategoryFinderResponse($this->service->__invoke(CategoryId::create($query->id())));
    }
}
