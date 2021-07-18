<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Post;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Post\PostNotExist;
use App\Magazine\Domain\Post\PostRepository;

final class PostFinder
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Post
    {
        $post = $this->repository->find($id);

        if (null === $post) {
            throw new PostNotExist($id);
        }

        return $post;
    }
}
