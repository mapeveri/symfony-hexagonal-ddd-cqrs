<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Infrastructure\Persistence\Elasticsearch\Repository;

use App\Magazine\Portal\Domain\PortalRepository;
use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticQuery;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchCriteriaConverter;

final class ElasticsearchPortalRepository implements PortalRepository
{
    private const INDEX = 'portal-front';

    public function __construct(private ElasticsearchClient $client)
    {
    }

    public function search(Criteria $criteria): array
    {
        /* @var ElasticQuery $converter */
        $converter = ElasticsearchCriteriaConverter::convert($criteria);

        $response = $this->client->client()->search([
            'index' => $this->client->indexPrefix(),
            'type' => self::INDEX,
            'body' => $converter->query()->toArray()
        ]);

        return [
            'data' => $response
        ];
    }

    public function add(string $id, array $data): void
    {
        $this->client->persist(self::INDEX, $id, $data);
    }
}
