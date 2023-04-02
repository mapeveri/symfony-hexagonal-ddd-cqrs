<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain;

use App\Shared\Domain\Aggregate\EventSourcedAggregateRoot;
use App\Shared\Domain\DatetimeUtils;
use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\ValueObjects\Uuid;
use App\Venue\Comment\Domain\Comment;
use App\Venue\Comment\Domain\Events\CommentWasAddedEvent;
use App\Venue\Comment\Domain\ValueObjects\CommentId;
use App\Venue\Event\Domain\Events\EventWasCreatedEvent;
use App\Venue\Event\Domain\Events\EventWasUpdatedEvent;
use App\Venue\Event\Domain\ValueObjects\EventId;
use DateTime;

class Event extends EventSourcedAggregateRoot
{
    private DateTime $created;
    private DateTime $updated;
    private array $comments;

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
        $this->comments = [];
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

    public function makeComment(string $content, string $username, EventId $eventId): void
    {
        $now = (new DateTime())->format(DatetimeUtils::DATETIME_FORMAT);
        $this->record(
            new CommentWasAddedEvent(
                CommentId::random()->value(),
                $content,
                $username,
                $eventId->value(),
                $now,
                $now,
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

    public function comments(): array
    {
        return $this->comments;
    }

    public function applyEventWasCreatedEvent(EventWasCreatedEvent $event)
    {
        $this->id = EventId::create($event->aggregateId());
        $this->title = $event->title();
        $this->content = $event->content();
        $this->location = $event->location();
        $this->startAt = new DateTime($event->startAt());
        $this->endAt = new DateTime($event->endAt());
        $this->created = new DateTime($event->created());
        $this->updated = new DateTime($event->updated());
    }

    public function applyEventWasUpdatedEvent(EventWasUpdatedEvent $event)
    {
        $this->title = $event->title();
        $this->content = $event->content();
        $this->location = $event->location();
        $this->startAt = new DateTime($event->startAt());
        $this->endAt = new DateTime($event->endAt());
    }

    public function applyCommentWasAddedEvent(CommentWasAddedEvent $event)
    {
        $this->comments[] = Comment::create(
            CommentId::create($event->aggregateId()),
            $event->content(),
            $event->username(),
            EventId::create($event->eventId()),
            $event->hidden(),
        );
    }

    public static function reconstituteFrom(EventStream $eventStream): self
    {
        $event = static::createEmptyEventWith(Uuid::create($eventStream->aggregateId()));

        $event->replay($eventStream);

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
