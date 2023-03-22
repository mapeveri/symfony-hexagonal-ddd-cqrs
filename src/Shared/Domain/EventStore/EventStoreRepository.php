<?php

declare(strict_types=1);

namespace App\Shared\Domain\EventStore;

use App\Shared\Domain\Aggregate\AggregateHistory;
use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\ValueObjects\Uuid;

interface EventStoreRepository
{
    public function commit(EventStream $eventStream): void;

    public function getAggregateHistoryFor(Uuid $id): AggregateHistory;
}