<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Query\Find;

use App\Magazine\Post\Domain\Post;
use App\Magazine\Post\Domain\PostRepository;
use App\Magazine\Post\Domain\Services\PostFinder as DomainPostFinder;
use App\Magazine\Post\Domain\ValueObjects\PostId;

final class PostFinder
{
    private DomainPostFinder $finder;

    public function __construct(PostRepository $repository)
    {
        $this->finder = new DomainPostFinder($repository);
    }

    public function __invoke(PostId $id): Post
    {
        return $this->finder->__invoke($id);
    }
}
