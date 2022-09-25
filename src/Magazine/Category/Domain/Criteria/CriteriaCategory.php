<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain\Criteria;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\FilterOperator;
use App\Shared\Domain\Criteria\Filters;

final class CriteriaCategory
{
    public function __invoke(?string $name, ?bool $hidden): Criteria
    {
        $filters = [];

        if (null !== $name) {
            $filters[] = [
                'field' => 'name',
                'operator' => FilterOperator::EQUAL,
                'value' => $name
            ];
        }

        if (null !== $hidden) {
            $filters[] = [
                'field' => 'hidden',
                'operator' => FilterOperator::EQUAL,
                'value' => $hidden
            ];
        }

        return new Criteria(
            Filters::fromValues($filters),
            null,
        );
    }
}