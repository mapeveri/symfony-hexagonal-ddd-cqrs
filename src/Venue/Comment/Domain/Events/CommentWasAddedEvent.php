<?php

declare(strict_types=1);

namespace App\Venue\Comment\Domain\Events;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class CommentWasAddedEvent extends DomainEvent
{
    public function __construct(
        private string $id,
        private string $content,
        private string $username,
        private string $eventId,
        private string $created,
        private string $updated,
        private ?bool $hidden = false,
        string $eventDomainId = null,
        string $occurredOn = null,
    ) {
        parent::__construct($this->id, $eventDomainId, $occurredOn);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function hidden(): bool
    {
        return $this->hidden;
    }

    public function created(): string
    {
        return $this->created;
    }

    public function updated(): string
    {
        return $this->updated;
    }

    public static function fromPrimitives(string $aggregateId, array $body, string $eventId, string $occurredOn): DomainEvent
    {
        return new self(
            $aggregateId,
            $body['content'],
            $body['username'],
            $body['eventId'],
            $body['hidden'],
            $body['created'],
            $body['updated'],
            $eventId,
            $occurredOn
        );
    }

    public static function eventName(): string
    {
        return 'comment.added';
    }

    public function toPrimitives(): array
    {
        return [
            'content' => $this->content,
            'username' => $this->username,
            'hidden' => $this->hidden,
            'eventId' => $this->eventId,
            'created' => $this->created,
            'updated' => $this->updated,
        ];
    }
}
