<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filter;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use function Lambdish\Phunctional\each;

final class ElasticsearchCriteriaConverter
{
    private BoolQuery $boolQuery;
    private Query $query;

    private function __construct(private Criteria $criteria)
    {
        $this->boolQuery = new BoolQuery();
        $this->query = new Query();
    }

    public static function convert(Criteria $criteria): ElasticQuery
    {
        $converter = new self($criteria);

        $query = $converter->makeQuery();

        return new ElasticQuery($query, null);
    }

    private function makeQuery(): Query
    {
        $this->formatQuery();
        $this->formatOrder();

        return $this->query;
    }

    private function formatQuery(): void
    {
        if ($this->criteria->hasFilters()) {
            $generator = new ElasticQueryGenerator();

            each(function (Filter $filter) use ($generator) {
                if (null !== $filter->value()->value()) {
                    $generator->__invoke($filter)($this->boolQuery);
                }
            }, $this->criteria->filters());

            $this->query->setQuery($this->boolQuery);
        }
    }

    private function formatOrder(): void
    {
        if ($this->criteria->hasOrder()) {
            $this->query->addSort([
                $this->criteria->order()->orderBy()->value() => $this->criteria->order()->orderType()->id()
            ]);
        }
    }
}