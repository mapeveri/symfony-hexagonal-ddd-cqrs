<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Query\Find;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\DatetimeUtils;
use App\Venue\Event\Domain\EventViewRepository;
use App\Venue\Event\Domain\ValueObjects\EventViewId;

final class EventFinderResponseQueryHandler implements QueryHandler
{
    public function __construct(private EventViewRepository $eventViewRepository)
    {
    }

    public function __invoke(EventFinderResponseQuery $query): ?Response
    {
        $eventView = $this->eventViewRepository->find(EventViewId::create($query->id()));
        if ($eventView === null) {
            return null;
        }

        return new EventFinderResponse(
            $eventView->id()->value(),
            $eventView->title(),
            $eventView->content(),
            $eventView->location(),
            $eventView->startAt()->format(DatetimeUtils::DATETIME_FORMAT),
            $eventView->endAt()->format(DatetimeUtils::DATETIME_FORMAT),
            $eventView->comments(),
        );
    }
}
