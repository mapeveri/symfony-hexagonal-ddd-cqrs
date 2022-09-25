<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\GetAll;

use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\Criteria\CriteriaCategory;

final class CategoryGetAll
{
    public function __construct(private CategoryRepository $repository, private CriteriaCategory $criteria)
    {
    }

    public function __invoke(?string $name, ?bool $hidden): array
    {
        $criteria = $this->criteria->__invoke($name, $hidden);
        return $this->repository->search($criteria);
    }
}
