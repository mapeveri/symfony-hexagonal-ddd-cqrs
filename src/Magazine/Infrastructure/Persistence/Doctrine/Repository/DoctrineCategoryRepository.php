<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Persistence\Doctrine\Repository;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Category\CategoryRepository;
use App\Magazine\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;

final class DoctrineCategoryRepository extends DoctrineRepository implements CategoryRepository
{
    public function getAll(): array
    {
        return $this->repository(Category::class)->findAll();
    }

    public function find(string $id): ?Category
    {
        return $this->repository(Category::class)->find($id);
    }

    public function findByName(string $name): ?Category
    {
        return $this->repository(Category::class)->findOneBy(['name' => $name]);
    }

    public function save(Category $category): void
    {
        $this->persist($category);
    }

    public function delete(Category $category): void
    {
        $this->remove($category);
    }
}
