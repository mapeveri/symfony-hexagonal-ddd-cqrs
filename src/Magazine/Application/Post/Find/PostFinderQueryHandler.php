<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Find;

use App\Magazine\Shared\Domain\Bus\Query\Response;
use App\Magazine\Shared\Domain\Bus\Query\QueryHandler;
use App\Magazine\Application\Post\Find\PostFinder;
use App\Magazine\Application\Post\Find\PostFinderQuery;
use App\Magazine\Application\Post\Find\PostFinderResponse;

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
