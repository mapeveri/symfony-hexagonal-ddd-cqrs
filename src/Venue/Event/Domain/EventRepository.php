<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain;

use App\Venue\Event\Domain\ValueObjects\EventId;

interface EventRepository
{
    public function find(EventId $eventId): ?Event;

    public function save(Event $aggregate): void;
}
