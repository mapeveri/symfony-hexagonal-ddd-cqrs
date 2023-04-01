<?php

declare(strict_types=1);

namespace App\Venue\Event\Infrastructure\EventStore;

use App\Shared\Domain\EventStore\EventStoreRepository;
use App\Shared\Domain\Snapshot\Snapshot;
use App\Shared\Domain\Snapshot\SnapshotRepository;
use App\Venue\Event\Domain\Event;
use App\Venue\Event\Domain\EventProjection;
use App\Venue\Event\Domain\EventRepository as BaseEventRepository;
use App\Venue\Event\Domain\ValueObjects\EventId;

final class EventRepository implements BaseEventRepository
{
    public function __construct(
        private EventStoreRepository $eventStore,
        private SnapshotRepository $snapshotRepository,
        private EventProjection $eventProjection
    ) {
    }

    public function find(EventId $eventId): ?Event
    {
        $snapshot = $this->snapshotRepository->findById($eventId->value());
        if (null === $snapshot) {
            $aggregateHistory = $this->eventStore->getAggregateHistoryFor($eventId);
            return Event::reconstituteFrom($aggregateHistory);
        }

        $event = $snapshot->aggregate();

        $event->replay(
            $this->eventStore->fromVersion($eventId->value(), $snapshot->version())
        );

        /** @var Event */
        return $event;
    }

    public function save(Event $aggregate): void
    {
        $events = $aggregate->getRecordedEvents();

        $countOfEvents = $this->eventStore->countEventsFor($aggregate->id());
        $version = (int) ($countOfEvents / 100);

        $this->eventStore->commit($events, $version);
        $aggregate->clearRecordedEvents();

        if (!$this->snapshotRepository->has($aggregate->id()->value(), $version)) {
            $this->snapshotRepository->save(
                $aggregate->id()->value(),
                new Snapshot(
                    $aggregate,
                    $version
                )
            );
        }

        $this->eventProjection->project($events);
    }
}
