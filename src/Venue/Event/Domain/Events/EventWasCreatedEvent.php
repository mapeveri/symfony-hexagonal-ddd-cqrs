<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain\Events;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class EventWasCreatedEvent extends DomainEvent
{
    public function __construct(
        private string $id,
        private string $title,
        private string $content,
        private string $location,
        private string $startAt,
        private string $endAt,
        private string $created,
        private string $updated,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($this->id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'event.created';
    }

    public static function eventClass(): string
    {
        return self::class;
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self(
            $aggregateId,
            $body['title'],
            $body['content'],
            $body['location'],
            $body['startAt'],
            $body['endAt'],
            $body['created'],
            $body['updated'],
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'location' => $this->location,
            'startAt' => $this->startAt,
            'endAt' => $this->endAt,
            'created' => $this->created,
            'updated' => $this->updated,
        ];
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

    public function startAt(): string
    {
        return $this->startAt;
    }

    public function endAt(): string
    {
        return $this->endAt;
    }

    public function created(): string
    {
        return $this->created;
    }

    public function updated(): string
    {
        return $this->updated;
    }
}
