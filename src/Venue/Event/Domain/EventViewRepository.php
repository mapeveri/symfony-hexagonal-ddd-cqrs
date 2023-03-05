<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain;

use App\Shared\Domain\Criteria\Criteria;
use App\Venue\Event\Domain\ValueObjects\EventViewId;

interface EventViewRepository
{
    public function get(EventViewId $id): ?EventView;

    public function search(Criteria $criteria): array;
}
