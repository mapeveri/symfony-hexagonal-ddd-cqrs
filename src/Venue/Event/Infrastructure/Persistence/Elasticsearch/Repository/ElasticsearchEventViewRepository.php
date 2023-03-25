<?php

declare(strict_types=1);

namespace App\Venue\Event\Infrastructure\Persistence\Elasticsearch\Repository;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticQuery;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchCriteriaConverter;
use App\Venue\Event\Domain\EventView;
use App\Venue\Event\Domain\EventViewRepository;
use App\Venue\Event\Domain\ValueObjects\EventViewId;
use DateTime;
use function Lambdish\Phunctional\map;

final class ElasticsearchEventViewRepository implements EventViewRepository
{
    private string $indexName;

    public function __construct(private readonly ElasticsearchClient $client)
    {
        $this->indexName = EventView::projectionName();
    }

    public function find(EventViewId $id): ?EventView
    {
        $response = $this->client->client()->search([
            'index' => $this->indexName,
            'body' => [
                'query' => [
                    'term' => [
                        '_id' => $id->value(),
                    ],
                ],
            ]
        ]);

        if (count($response) === 0) {
            return null;
        }

        if (empty($response['hits']['hits'])) {
            return null;
        }

        return $this->getEventViewFromArray($response['hits']['hits'][0]);
    }

    public function search(Criteria $criteria): array
    {
        /* @var ElasticQuery $converter */
        $converter = ElasticsearchCriteriaConverter::convert($criteria);

        $response = $this->client->client()->search([
            'index' => $this->indexName,
            'body' => $converter->query()->toArray()
        ]);

        if (count($response) === 0) {
            return [];
        }

        $data = map($this->getEventView(), $response['hits']['hits']);
        return [
            'data' => $data
        ];
    }

    private function getEventView(): callable
    {
        return fn(array $eventView) => $this->getEventViewFromArray($eventView);
    }

    private function getEventViewFromArray(array $eventView): EventView
    {
        return EventView::createFromArray([
            'id' => $eventView['_id'],
            'title' => $eventView['_source']['title'],
            'content' => $eventView['_source']['content'],
            'location' => $eventView['_source']['location'],
            'comments' => $eventView['_source']['comments'],
            'startAt' => new DateTime($eventView['_source']['startAt']),
            'endAt' => new DateTime($eventView['_source']['endAt']),
        ]);
    }
}
