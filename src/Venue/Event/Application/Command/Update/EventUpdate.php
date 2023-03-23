<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Command\Update;

use App\Venue\Event\Domain\EventRepository;
use App\Venue\Event\Domain\Exceptions\EventNotExistException;
use App\Venue\Event\Domain\ValueObjects\EventId;
use DateTime;

final class EventUpdate
{
    public function __construct(private EventRepository $repository)
    {
    }

    public function __invoke(string $id, string $title, string $content, string $location, string $startAt, string $endAt): void
    {
        $event = $this->repository->find(EventId::create($id));
        if (null === $event) {
            throw new EventNotExistException($id);
        }

        $event->update(
            $title,
            $content,
            $location,
            new DateTime($startAt),
            new DateTime($endAt),
        );

        $this->repository->save($event);
    }
}
