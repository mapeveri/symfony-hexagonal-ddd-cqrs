<?php

namespace App\Venue\Event\Infrastructure\EventStore;

use App\Shared\Domain\EventStore\EventStoreRepository;
use App\Venue\Event\Domain\Event;
use App\Venue\Event\Domain\EventProjection;
use App\Venue\Event\Domain\EventRepository as BaseEventRepository;

final class EventRepository implements BaseEventRepository
{
    public function __construct(private EventStoreRepository $eventStore, private EventProjection $eventProjection)
    {
    }

    public function save(Event $aggregate): void
    {
        $events = $aggregate->getRecordedEvents();

        $this->eventStore->commit($events);
        $this->eventProjection->project($events);

        $aggregate->clearRecordedEvents();
    }
}