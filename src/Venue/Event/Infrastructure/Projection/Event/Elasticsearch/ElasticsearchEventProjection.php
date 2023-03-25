<?php

declare(strict_types=1);

namespace App\Venue\Event\Infrastructure\Projection\Event\Elasticsearch;

use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;
use App\Shared\Infrastructure\Projection\BaseProjection;
use App\Venue\Event\Domain\EventProjection;
use App\Venue\Event\Domain\Events\EventWasCreatedEvent;
use App\Venue\Event\Domain\Events\EventWasUpdatedEvent;
use App\Venue\Event\Domain\EventView;

final class ElasticsearchEventProjection extends BaseProjection implements EventProjection
{
    private string $indexName;

    public function __construct(private readonly ElasticsearchClient $client)
    {
        $this->indexName = EventView::projectionName();
    }

    public function projectEventWasCreatedEvent(EventWasCreatedEvent $event): void
    {
        $this->client->persist(
            $this->indexName,
            $event->aggregateId(),
            [
                'title' => $event->title(),
                'content' => $event->content(),
                'location' => $event->location(),
                'startAt' => $event->startAt(),
                'endAt' => $event->endAt(),
                'created' => $event->created(),
                'updated' => $event->updated(),
                'comments' => []
            ]
        );
    }

    public function projectEventWasUpdatedEvent(EventWasUpdatedEvent $event): void
    {
        $this->client->partialPersist(
            $this->indexName,
            $event->aggregateId(),
            [
                'title' => $event->title(),
                'content' => $event->content(),
                'location' => $event->location(),
                'startAt' => $event->startAt(),
                'endAt' => $event->endAt(),
            ]
        );
    }
}
