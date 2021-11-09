<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Category;

use App\Magazine\Domain\Entity\Category;

interface CategoryRepository
{
    public function getAll(): array;

    public function find(string $id): ?Category;

    public function findByName(string $name): ?Category;

    public function save(Category $category): void;

    public function delete(Category $category): void;
}
