<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Post;

use function uniqid;
use App\Magazine\Shared\Domain\Bus\Event\Event;
use App\Magazine\Shared\Domain\Event\DomainEvent;

final class PostWasCreatedEvent extends DomainEvent implements Event
{
    private string $id;
    private string $title;
    private string $content;
    private int $categoryId;
    private int $userId;
    private bool $hidden;

    public function __construct(
        string $title,
        string $content,
        int $categoryId,
        int $userId,
        bool $hidden,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $this->id = uniqid();
        $this->title = $title;
        $this->content = $content;
        $this->categoryId = $categoryId;
        $this->userId = $userId;
        $this->hidden = $hidden;

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

    public function categoryId(): int
    {
        return $this->categoryId;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function hidden(): bool
    {
        return $this->hidden;
    }
}