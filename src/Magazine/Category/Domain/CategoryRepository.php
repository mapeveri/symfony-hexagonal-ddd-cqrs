<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

interface CategoryRepository
{
    public function getAll(): array;

    public function find(string $id): ?Category;

    public function findByName(string $name): ?Category;

    public function save(Category $category): void;

    public function delete(Category $category): void;
}