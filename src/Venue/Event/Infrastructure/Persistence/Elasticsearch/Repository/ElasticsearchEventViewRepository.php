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
use function Lambdish\Phunctional\map;

final class ElasticsearchEventViewRepository implements EventViewRepository
{
    private const INDEX = EventView::NAME;

    public function __construct(private readonly ElasticsearchClient $client)
    {
    }

    public function get(EventViewId $id): ?EventView
    {
        return null;
    }

    public function search(Criteria $criteria): array
    {
        /* @var ElasticQuery $converter */
        $converter = ElasticsearchCriteriaConverter::convert($criteria);

        $response = $this->client->client()->search([
            'index' => self::INDEX,
            'body' => $converter->query()->toArray()
        ]);

        if (count($response) === 0) {
            return [];
        }

        $data = map(self::getEventView(), $response['hits']['hits']);
        return [
            'data' => $data
        ];
    }

    private static function getEventView(): callable
    {
        return static fn(array $eventView) => EventView::create([
            'id' => $eventView['_source']['id'],
            'title' => $eventView['_source']['title'],
            'content' => $eventView['_source']['content'],
            'location' => $eventView['_source']['location'],
            'comments' => $eventView['_source']['comments'],
            'startAt' => $eventView['_source']['startAt'],
            'endAt' => $eventView['_source']['endAt'],
        ]);
    }
}