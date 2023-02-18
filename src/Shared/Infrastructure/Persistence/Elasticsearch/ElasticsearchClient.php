<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

use Elasticsearch\Client;

final class ElasticsearchClient
{
    public function __construct(private Client $client, private string $indexPrefix)
    {
    }

    public function persist(string $name, string $identifier, array $plainBody): void
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