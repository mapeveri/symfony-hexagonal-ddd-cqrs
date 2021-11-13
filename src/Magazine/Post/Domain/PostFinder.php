<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain;

final class PostFinder
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ?Post
    {
        $post = $this->repository->find($id);

        if (null === $post) {
            throw new PostNotExist($id);
        }

        return $post;
    }
}
