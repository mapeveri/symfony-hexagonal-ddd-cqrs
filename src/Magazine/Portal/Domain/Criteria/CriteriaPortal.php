<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Domain\Criteria;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\FilterOperator;
use App\Shared\Domain\Criteria\Filters;

final class CriteriaPortal
{
    public function __invoke(?string $search, ?array $ids): Criteria
    {
        $filters = [];

        if (null !== $search) {
            $filters[] = [
                'field' => '',
                'operator' => FilterOperator::CONTAINS,
                'value' => $search
            ];
        }

        if (null !== $ids) {
            $filters[] = [
                'field' => '_id',
                'operator' => FilterOperator::IN,
                'value' => $ids
            ];
        }

        return new Criteria(
            Filters::fromValues($filters),
            null,
        );
    }
}