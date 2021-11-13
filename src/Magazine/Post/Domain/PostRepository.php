<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain;

interface PostRepository
{
    public function getAll(): array;

    public function find(string $id): ?Post;

    public function save(Post $post): void;

    public function delete(Post $post): void;
}
