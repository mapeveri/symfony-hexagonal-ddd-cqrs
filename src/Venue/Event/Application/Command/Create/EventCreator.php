<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Command\Create;

use App\Venue\Event\Domain\Event;
use App\Venue\Event\Domain\EventRepository;
use App\Venue\Event\Domain\ValueObjects\EventId;
use DateTime;

final class EventCreator
{
    public function __construct(private EventRepository $repository)
    {
    }

    public function __invoke(string $id, string $title, string $content, string $location, string $startAt, string $endAt): void
    {
        $event = Event::create(
            EventId::create($id),
            $title,
            $content,
            $location,
            new DateTime($startAt),
            new DateTime($endAt),
        );

        $this->repository->save($event);
    }
}
