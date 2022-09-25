<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Criteria\Criteria;

interface CategoryRepository
{
    public function search(Criteria $criteria): array;

    public function find(CategoryId $id): ?Category;

    public function findByName(string $name): ?Category;

    public function save(Category $category): void;

    public function delete(Category $category): void;
}
