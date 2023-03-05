<?php

declare(strict_types=1);

namespace App\Venue\Event\Infrastructure\Projection\Event\Elasticsearch;

use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;
use App\Shared\Infrastructure\Projection\BaseProjection;
use App\Venue\Event\Domain\EventProjection;
use App\Venue\Event\Domain\Events\EventWasCreatedEvent;
use App\Venue\Event\Domain\EventView;

final class ElasticsearchEventProjection extends BaseProjection implements EventProjection
{
    private const INDEX = EventView::NAME;

    public function __construct(private readonly ElasticsearchClient $client)
    {
    }

    public function projectEventWasCreatedEvent(EventWasCreatedEvent $event): void
    {
        $this->client->persist(
            self::INDEX,
            $event->aggregateId(),
            [
                'title' => $event->title(),
                'content' => $event->content(),
                'location' => $event->location(),
                'startAt' => $event->startAt(),
                'endAt' => $event->endAt(),
                'comments' => []
            ]
        );
    }
}