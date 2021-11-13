<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Query\Find;

use App\Magazine\Post\Domain\PostFinder as DomainPostFinder;
use App\Magazine\Post\Domain\Post;
use App\Magazine\Post\Domain\PostRepository;

final class PostFinder
{
    private DomainPostFinder $finder;

    public function __construct(PostRepository $repository)
    {
        $this->finder = new DomainPostFinder($repository);
    }

    public function __invoke(string $id): Post
    {
        return $this->finder->__invoke($id);
    }
}
