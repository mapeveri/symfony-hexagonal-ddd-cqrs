<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Persistence\Elasticsearch\Repository;

use App\Magazine\Domain\Index\IndexRepository;
use App\Magazine\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;

final class ElasticsearchIndexRepository implements IndexRepository
{
    private ElasticsearchClient $client;

    private string $index = 'index-data';

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
