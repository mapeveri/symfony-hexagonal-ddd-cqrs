<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Projection\Elasticsearch;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchClient;

final class PostProjection
{
    private ElasticsearchClient $client;

    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    public function project(Post $post): void
    {
        $this->projectPostWasCreated($post);
    }

    public function projectPostWasCreated(Post $post): void
    {
        $data = ["title" => $post->title(), "content" => $post->content()];
        $this->client->persist('index-data', $post->id(), $data);
    }
}
