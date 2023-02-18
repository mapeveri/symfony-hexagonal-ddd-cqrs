<?php

declare(strict_types=1);

namespace App\Magazine\Post\Domain\Events;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class PostWasCreatedEvent extends DomainEvent
{
    public function __construct(
        private string $id,
        private string $title,
        private string $content,
        private string $categoryId,
        private string $userId,
        private bool $hidden,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($this->id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'post.created';
    }

    public static function eventClass(): string
    {
        return self::class;
    }

    public static function fromPrimitives(
        string $id,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self(
            $id,
            $body['title'],
            $body['content'],
            $body['categoryId'],
            $body['userId'],
            $body['hidden'],
            $eventId,
            $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'categoryId' => $this->categoryId,
            'userId' => $this->userId,
            'hidden' => $this->hidden,
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

    public function categoryId(): string
    {
        return $this->categoryId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function hidden(): bool
    {
        return $this->hidden;
    }
}