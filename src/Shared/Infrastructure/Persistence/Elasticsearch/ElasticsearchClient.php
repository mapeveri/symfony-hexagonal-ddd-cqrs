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
        $this->client->update(
            [
                'index' => $name,
                'type' => $name,
                'id'    => $identifier,
                'body'  => ['doc' => $plainBody, 'doc_as_upsert' => true],
            ]
        );
    }

    public function client(): Client
    {
        return $this->client;
    }
}
