<?php

declare(strict_types=1);

namespace App\Magazine\Shared\Infrastructure\Persistence\Elasticsearch;

use Elasticsearch\Client;

final class ElasticsearchClient
{
    private Client $client;
    private string $indexPrefix;

    public function __construct(Client $client, string $indexPrefix)
    {
        $this->client = $client;
        $this->indexPrefix = $indexPrefix;
    }

    public function persist(string $name, int $identifier, array $plainBody): void
    {
        $this->client->index(
            [
                'index' => $this->indexPrefix,
                'type' => $name,
                'id'    => $identifier,
                'body'  => $plainBody,
            ]
        );
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function indexPrefix(): string
    {
        return $this->indexPrefix;
    }
}