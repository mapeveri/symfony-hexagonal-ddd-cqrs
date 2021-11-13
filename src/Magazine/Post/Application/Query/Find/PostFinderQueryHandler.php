<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Query\Find;

use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class PostFinderQueryHandler implements QueryHandler
{
    private PostFinder $service;

    public function __construct(PostFinder $service)
    {
        $this->service = $service;
    }

    public function __invoke(PostFinderQuery $query): Response
    {
        return new PostFinderResponse($this->service->__invoke($query->id()));
    }
}
