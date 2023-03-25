<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Exceptions\CorruptAggregateHistory;
use App\Shared\Domain\ValueObjects\Uuid;

final class AggregateHistory
{
    public function __construct(private Uuid $aggregateId, private array $events)
    {
        /** @var $event DomainEvent */
        foreach($events as $event) {
            if(!$aggregateId->equals(Uuid::create($event->aggregateId()))) {
                throw new CorruptAggregateHistory;
            }
        }
    }

    public function aggregateId(): Uuid
    {
        return $this->aggregateId;
    }

    public function isEmptyEventStream(): bool
    {
        return count($this->events) === 0;
    }
}