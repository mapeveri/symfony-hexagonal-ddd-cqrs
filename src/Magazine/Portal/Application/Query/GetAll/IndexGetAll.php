<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Query\GetAll;

use App\Magazine\Portal\Domain\Criteria\CriteriaPortal;
use App\Magazine\Portal\Domain\PortalRepository;

final class IndexGetAll
{
    public function __construct(private PortalRepository $repository, private CriteriaPortal $criteria)
    {
    }

    public function __invoke(?string $search, ?array $ids): array
    {
        $criteria = $this->criteria->__invoke($search, $ids);
        return $this->repository->search($criteria);
    }
}
