<?php

declare(strict_types=1);

namespace App\Venue\Comment\Application\Create;

use App\Venue\Event\Domain\EventRepository;
use App\Venue\Event\Domain\Exceptions\EventNotExistException;
use App\Venue\Event\Domain\ValueObjects\EventId;

final class CommentCreator
{
    public function __construct(private EventRepository $eventRepository)
    {
    }

    public function __invoke(string $eventId, string $content, string $username): void
    {
        $eventId = EventId::create($eventId);
        $event = $this->eventRepository->find($eventId);
        if ($event === null) {
            throw new EventNotExistException($eventId->value());
        }

        $event->makeComment($content, $username, $eventId);

        $this->eventRepository->save($event);
    }
}
