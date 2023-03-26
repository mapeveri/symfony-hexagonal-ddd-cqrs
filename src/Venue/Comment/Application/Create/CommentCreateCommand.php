<?php

declare(strict_types=1);

namespace App\Venue\Comment\Application\Create;

use App\Shared\Domain\Bus\Command\Command;

final class CommentCreateCommand implements Command
{
    public function __construct(private string $eventId, private string $content, private string $username)
    {
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function username(): string
    {
        return $this->username;
    }
}
