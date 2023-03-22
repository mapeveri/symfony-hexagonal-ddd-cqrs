<?php

declare(strict_types=1);

namespace App\Venue\Event\Infrastructure\EventStore;

use App\Shared\Domain\EventStore\EventStoreRepository;
use App\Venue\Event\Domain\Event;
use App\Venue\Event\Domain\EventProjection;
use App\Venue\Event\Domain\EventRepository as BaseEventRepository;
use App\Venue\Event\Domain\ValueObjects\EventId;

final class EventRepository implements BaseEventRepository
{
    public function __construct(private EventStoreRepository $eventStore, private EventProjection $eventProjection)
    {
    }

    public function find(EventId $eventId): Event
    {
        $eventStream = $this->eventStore->getAggregateHistoryFor($eventId);

        return Event::reconstituteFrom($eventStream);
    }

    public function save(Event $aggregate): void
    {
        $events = $aggregate->getRecordedEvents();

        $this->eventStore->commit($events);
        $this->eventProjection->project($events);

        $aggregate->clearRecordedEvents();
    }
}
