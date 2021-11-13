<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

final class ElasticsearchClientFactory
{
    public function __invoke(
        string $host,
        string $indexPrefix,
        string $schemasFolder,
        string $environment
    ): ElasticsearchClient {
        $client = ClientBuilder::create()->setHosts([$host])->build();

        $this->generateIndexIfNotExists($client, $indexPrefix, $schemasFolder, $environment);

        return new ElasticsearchClient($client, $indexPrefix);
    }

    private function generateIndexIfNotExists(
        Client $client,
        string $indexPrefix,
        string $schemasFolder,
        string $environment
    ): void {
        if ('prod' !== $environment) {
            return;
        }

        $indexes = scandir($schemasFolder);

        foreach ($indexes as $index) {
            $indexName = str_replace('.json', '', sprintf('%s_%s', $indexPrefix, $index));

            if (!$this->indexExists($client, $indexName)) {
                $indexBody = json_decode(file_get_contents("$schemasFolder/$index"), true);

                $client->indices()->create(['index' => $indexName, 'body' => $indexBody]);
            }
        }
    }

    private function indexExists(Client $client, string $indexName): bool
    {
        try {
            $client->indices()->getSettings(['index' => $indexName]);

            return true;
        } catch (Missing404Exception $ex) {
            return false;
        }
    }
}
