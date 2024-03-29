<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Infrastructure\Persistence\Elasticsearch\Repository;

use App\Magazine\Portal\Domain\PortalPost;
use App\Magazine\Portal\Domain\PortalRepository;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticQuery;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchCriteriaConverter;
use function Lambdish\Phunctional\map;

final class ElasticsearchPortalRepository implements PortalRepository
{
    private const INDEX = 'magazine-portal-front';

    public function __construct(private readonly ElasticsearchClient $client)
    {
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

        $data = map(self::getPortalPost(), $response['hits']['hits']);
        return [
            'data' => $data
        ];
    }

    public function save(PortalPost $portalPost): void
    {
        $this->client->persist(self::INDEX, $portalPost->id(), $portalPost->toArray());
    }

    private static function getPortalPost(): callable
    {
        return static fn(array $post) => [
            'id' => $post['_source']['id'],
            'title' => $post['_source']['title'],
            'content' => $post['_source']['content'],
        ];
    }
}
