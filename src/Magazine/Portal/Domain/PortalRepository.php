<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Domain;

use App\Shared\Domain\Criteria\Criteria;

interface PortalRepository
{
    public function search(Criteria $criteria): array;

    public function add(string $id, array $data): void;
}
