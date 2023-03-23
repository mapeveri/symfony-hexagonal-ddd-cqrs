<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Command\Update;

use App\Shared\Domain\Bus\Command\Command;

final class EventUpdateCommand implements Command
{
    public function __construct(
        private string $id,
        private string $title,
        private string $content,
        private string $location,
        private string $startAt,
        private string $endAt
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
}
