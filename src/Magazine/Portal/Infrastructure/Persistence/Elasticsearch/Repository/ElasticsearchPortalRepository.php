<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Infrastructure\Persistence\Elasticsearch\Repository;

use App\Magazine\Portal\Domain\PortalRepository;
use App\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;

final class ElasticsearchPortalRepository implements PortalRepository
{
    private ElasticsearchClient $client;

    private string $index = 'portal-front';

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    public function getAll(): array
    {
        $response = $this->client->client()->search([
            'index' => $this->client->indexPrefix(),
            'type' => $this->index,
        ]);

        return [
            'data' => $response
        ];
    }

    public function add(string $id, array $data): void
    {
        $this->client->persist($this->index, (int)$id, $data);
    }
}
