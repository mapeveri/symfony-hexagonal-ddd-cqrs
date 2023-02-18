<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain\Services;

use App\Magazine\Post\Domain\Exceptions\PostNotExistException;
use App\Magazine\Post\Domain\Post;
use App\Magazine\Post\Domain\PostRepository;
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
            throw new PostNotExistException($id->value());
        }

        return $post;
    }
}
