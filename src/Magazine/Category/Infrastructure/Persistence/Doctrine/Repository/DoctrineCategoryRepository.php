<?php

declare(strict_types=1);

namespace App\Magazine\Category\Infrastructure\Persistence\Doctrine\Repository;

use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;

final class DoctrineCategoryRepository extends DoctrineRepository implements CategoryRepository
{
    private static array $criteriaToDoctrineFields = [
        'id' => 'id',
    ];
    
    public function search(Criteria $criteria): array
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria, self::$criteriaToDoctrineFields);
        $matching = $this->repository(Category::class)->matching($doctrineCriteria);

        return $matching->toArray();
    }

    public function find(CategoryId $id): ?Category
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
