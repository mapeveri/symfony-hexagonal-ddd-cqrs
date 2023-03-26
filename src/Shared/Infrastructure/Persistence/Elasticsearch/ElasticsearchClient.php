<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

use Elasticsearch\Client;

final class ElasticsearchClient
{
    public function __construct(private Client $client)
    {
    }

    public function persist(string $indexName, string $identifier, array $plainBody): void
    {
        $this->client->update(
            [
                'index' => $indexName,
                'type'  => $indexName,
                'id'    => $identifier,
                'body'  => ['doc' => $plainBody, 'doc_as_upsert' => true],
            ]
        );
    }

    public function addItemToArrayField(string $indexName, string $identifier, array $plainBody, string $field): void
    {
        $this->client->update(
            [
                'index' => $indexName,
                'type'  => $indexName,
                'id'    => $identifier,
                'body'  => [
                    "script" => [
                        "inline" => sprintf("ctx._source.%s.add(params.new_value)", $field),
                        "params" => [
                            'new_value' => $plainBody
                        ],
                    ]
                ],
            ]
        );
    }

    public function client(): Client
    {
        return $this->client;
    }
}
