<?php

declare(strict_types=1);

namespace App\Shared\Domain\EventStore;

use App\Shared\Domain\Aggregate\AggregateHistory;
use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\ValueObjects\Uuid;

interface EventStoreRepository
{
    public function commit(EventStream $eventStream, int $version): void;

    public function getAggregateHistoryFor(Uuid $id): AggregateHistory;

    public function countEventsFor(Uuid $id): int;

    public function fromVersion(string $id, int $version): EventStream;
}
