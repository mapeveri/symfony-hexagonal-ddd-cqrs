<?php

declare(strict_types=1);

namespace App\Shared\Domain\EventStore;

use App\Shared\Domain\EventStream\EventStream;

interface EventStoreRepository
{
    public function commit(EventStream $eventStream): void;

    // public function getAggregateHistoryFor(IdentifiesAggregate $id): AggregateHistory;
}