<?php

declare(strict_types=1);

namespace App\Venue\Comment\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Venue\Comment\Domain\ValueObjects\CommentId;
use App\Venue\Event\Domain\ValueObjects\EventId;
use DateTime;

class Comment extends AggregateRoot
{
    private DateTime $created;
    private DateTime $updated;

    public function __construct(
        private CommentId $id,
        private string $content,
        private string $username,
        private EventId $eventId,
        private ?bool $hidden = false
    ) {
        $this->created = new DateTime();
        $this->updated = new DateTime();
    }

    public static function create(CommentId $id, string $content, string $username, EventId $eventId, ?bool $hidden = false): self
    {
        return new self($id, $content, $username, $eventId, $hidden);
    }

    public function id(): CommentId
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

    public function eventId(): EventId
    {
        return $this->eventId;
    }

    public function hidden(): bool
    {
        return $this->hidden;
    }

    public function created(): DateTime
    {
        return $this->created;
    }

    public function updated(): DateTime
    {
        return $this->updated;
    }
}
