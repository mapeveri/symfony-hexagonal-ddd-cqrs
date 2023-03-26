<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Exceptions\CorruptAggregateHistory;
use App\Shared\Domain\ValueObjects\Uuid;

final class AggregateHistory
{
    public function __construct(private Uuid $aggregateId, private array $eventStream)
    {
        /** @var $event DomainEvent */
        foreach($eventStream as $event) {
            if(!$aggregateId->equals(Uuid::create($event->aggregateId()))) {
                throw new CorruptAggregateHistory;
            }
        }
    }

    public function aggregateId(): Uuid
    {
        return $this->aggregateId;
    }

    public function eventStream(): array
    {
        return $this->eventStream;
    }

    public function isEmptyEventStream(): bool
    {
        return count($this->eventStream()) === 0;
    }
}
