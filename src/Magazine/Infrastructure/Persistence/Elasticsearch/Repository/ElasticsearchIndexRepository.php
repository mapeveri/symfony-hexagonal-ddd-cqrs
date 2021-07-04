<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Persistence\Elasticsearch\Repository;

use App\Magazine\Domain\Index\IndexRepository;
use App\Magazine\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;

final class ElasticsearchIndexRepository implements IndexRepository
{
    private ElasticsearchClient $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }
    
    public function getAll(): array
    {
        $response = $this->client->client()->search([
            'index' => $this->client->indexPrefix(),
            'type' => 'index-data',
        ]);

        return [
            'data' => $response
        ];
    }
}
