<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Find;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Post\PostFinder as DomainPostFinder;
use App\Magazine\Domain\Post\PostRepository;

final class PostFinder
{
    private $repository;

    public function __construct(PostRepository $repository)
    {
        $this->finder = new DomainPostFinder($repository);
    }

    public function __invoke(int $id): Post
    {
        return $this->finder->__invoke($id);
    }
}
