<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain;

use App\Shared\Domain\Aggregate\AggregateHistory;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Aggregate\IsEventSourced;
use App\Shared\Domain\DatetimeUtils;
use App\Shared\Domain\ValueObjects\Uuid;
use App\Venue\Event\Domain\Events\EventWasCreatedEvent;
use App\Venue\Event\Domain\Events\EventWasUpdatedEvent;
use App\Venue\Event\Domain\ValueObjects\EventId;
use DateTime;

class Event extends AggregateRoot implements IsEventSourced
{
    private DateTime $created;
    private DateTime $updated;

    public function __construct(
        private EventId $id,
        private string $title,
        private string $content,
        private string $location,
        private DateTime $startAt,
        private DateTime $endAt
    ) {
        $this->created = new DateTime();
        $this->updated = new DateTime();
    }

    public static function create(EventId $id, string $title, string $content, string $location, DateTime $startAt, DateTime $endAt): self
    {
        $event = new self($id, $title, $content, $location, $startAt, $endAt);

        $event->record(
            new EventWasCreatedEvent(
                $id->value(),
                $title,
                $content,
                $location,
                $startAt->format(DatetimeUtils::DATETIME_FORMAT),
                $endAt->format(DatetimeUtils::DATETIME_FORMAT),
                $event->created()->format(DatetimeUtils::DATETIME_FORMAT),
                $event->updated()->format(DatetimeUtils::DATETIME_FORMAT)
            )
        );

        return $event;
    }

    public function update(string $title, string $content, string $location, DateTime $startAt, DateTime $endAt): void
    {
        $this->title = $title;
        $this->content = $content;
        $this->location = $location;
        $this->startAt = $startAt;
        $this->endAt = $endAt;

        $this->record(
            new EventWasUpdatedEvent(
                $this->id->value(),
                $title,
                $content,
                $location,
                $startAt->format(DatetimeUtils::DATETIME_FORMAT),
                $endAt->format(DatetimeUtils::DATETIME_FORMAT),
            )
        );
    }

    public function id(): EventId
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function location(): string
    {
        return $this->location;
    }

    public function startAt(): DateTime
    {
        return $this->startAt;
    }

    public function endAt(): DateTime
    {
        return $this->endAt;
    }

    public function created(): DateTime
    {
        return $this->created;
    }

    public function updated(): DateTime
    {
        return $this->updated;
    }

    private function applyEventWasCreated(EventWasCreatedEvent $event)
    {
        $this->title = $event->title();
        $this->content = $event->content();
        $this->location = $event->location();
        $this->startAt = new DateTime($event->startAt());
        $this->endAt = new DateTime($event->endAt());
        $this->created = new DateTime($event->created());
        $this->updated = new DateTime($event->updated());
    }

    private function applyEventWasUpdated(EventWasUpdatedEvent $event)
    {
        $this->title = $event->title();
        $this->content = $event->content();
        $this->location = $event->location();
        $this->startAt = new DateTime($event->startAt());
        $this->endAt = new DateTime($event->endAt());
    }

    public static function reconstituteFrom(AggregateHistory $aggregateHistory): self
    {
        $event = static::createEmptyEventWith($aggregateHistory->aggregateId());

        foreach ($aggregateHistory as $anEvent) {
            $event->apply($anEvent);
        }

        return $event;
    }

    private static function createEmptyEventWith(Uuid $eventId): self
    {
        return new self(
            EventId::create($eventId->value()),
            '',
            '',
            '',
            new DateTime(),
            new DateTime()
        );
    }
}
