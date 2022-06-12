<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Infrastructure\Persistence\Elasticsearch\Repository;

use App\Magazine\Portal\Domain\PortalRepository;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;

final class ElasticsearchPortalRepository implements PortalRepository
{
    private const INDEX = 'portal-front';

    public function __construct(private ElasticsearchClient $client)
    {
    }

    public function getAll(): array
    {
        $response = $this->client->client()->search([
            'index' => $this->client->indexPrefix(),
            'type' => self::INDEX,
        ]);

        return [
            'data' => $response
        ];
    }

    public function add(string $id, array $data): void
    {
        $this->client->persist(self::INDEX, (int)$id, $data);
    }
}
