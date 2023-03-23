<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

use Elasticsearch\Client;

final class ElasticsearchClient
{
    public function __construct(private Client $client)
    {
    }

    public function persist(string $name, string $identifier, array $plainBody): void
    {
        $this->client->index(
            [
                'index' => $name,
                'type' => $name,
                'id'    => $identifier,
                'body'  => $plainBody,
            ]
        );
    }

    public function partialPersist(string $name, string $identifier, array $plainBody): void
    {
        $this->client->update(
            [
                'index' => $name,
                'type' => $name,
                'id'    => $identifier,
                'body'  => ['doc' => $plainBody],
            ]
        );
    }

    public function client(): Client
    {
        return $this->client;
    }
}