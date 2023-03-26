<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Query\Find;

use App\Shared\Domain\Bus\Query\Response;

final class EventFinderResponse implements Response
{
    public function __construct(
        private string $id,
        private string $title,
        private string $content,
        private string $location,
        private string $startAt,
        private string $endAt,
        private array $comments,
    ) {
    }

    public function id(): string
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

    public function startAt(): string
    {
        return $this->startAt;
    }

    public function endAt(): string
    {
        return $this->endAt;
    }

    public function comments(): array
    {
        return $this->comments;
    }

    public function data(): array
    {
        return [
            'id' => $this->id(),
            'title' => $this->title(),
            'content' => $this->content(),
            'location' => $this->location(),
            'startAt' => $this->startAt(),
            'endAt' => $this->endAt(),
            'comments' => $this->comments(),
        ];
    }
}
