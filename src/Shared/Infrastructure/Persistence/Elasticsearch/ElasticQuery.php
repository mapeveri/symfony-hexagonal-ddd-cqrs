<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

use Elastica\Query;

class ElasticQuery
{
    public function __construct(private Query $query, private ?array $paginate)
    {
    }

    public function query(): Query
    {
        return $this->query;
    }

    public function paginate(): ?array
    {
        return $this->paginate;
    }
}