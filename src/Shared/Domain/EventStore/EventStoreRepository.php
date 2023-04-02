<?php

declare(strict_types=1);

namespace App\Shared\Domain\EventStore;

use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\ValueObjects\Uuid;

interface EventStoreRepository
{
    public function append(EventStream $eventStream, int $version): void;

    public function getAggregateHistoryFor(Uuid $id): EventStream;

    public function countEventsFor(Uuid $id): int;

    public function fromVersion(Uuid $id, int $version): EventStream;
}
