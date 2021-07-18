<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Persistence\Doctrine\Repository;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Post\PostRepository;
use App\Magazine\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;

final class DoctrinePostRepository extends DoctrineRepository implements PostRepository
{
    public function getAll(): array
    {
        return $this->repository(Post::class)->findAll();
    }

    public function find(int $id): ?Post
    {
        return $this->repository(Post::class)->find($id);
    }

    public function save(Post $post): void
    {
        $this->persist($post);
    }

    public function delete(Post $post): void
    {
        $this->remove($post);
    }
}
