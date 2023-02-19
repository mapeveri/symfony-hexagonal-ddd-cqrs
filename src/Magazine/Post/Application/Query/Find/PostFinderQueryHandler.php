<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Query\Find;

use App\Magazine\Post\Domain\ValueObjects\PostId;
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
        $post = $this->service->__invoke(PostId::create($query->id()));
        return new PostFinderResponse(
            $post->id()->value(),
            $post->title(),
            $post->content(),
            $post->category()?->name(),
            $post->user()->username(),
            $post->hidden(),
            $post->created(),
        );
    }
}
