<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain;

use App\Magazine\Post\Domain\ValueObjects\PostId;

final class PostFinder
{
    public function __construct(private PostRepository $repository)
    {
    }

    public function __invoke(PostId $id): ?Post
    {
        $post = $this->repository->find($id);

        if (null === $post) {
            throw new PostNotExist($id->value());
        }

        return $post;
    }
}
