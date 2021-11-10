<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Post;

use App\Magazine\Domain\Entity\Post;

interface PostRepository
{
    public function getAll(): array;

    public function find(string $id): ?Post;

    public function save(Post $post): void;

    public function delete(Post $post): void;
}
