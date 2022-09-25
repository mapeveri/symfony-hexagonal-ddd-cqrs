<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Elasticsearch;

use App\Shared\Domain\Criteria\Filter;
use App\Shared\Domain\Criteria\FilterOperator;
use Elastica\Query\BoolQuery;
use Elastica\Query\QueryString;
use Elastica\Query\Terms;
use Elastica\Query\Term;

final class ElasticQueryGenerator
{
    use ElasticSearchUtils;

    private const MUST_TYPE = 'must';
    private const MUST_NOT_TYPE = 'must_not';
    private const TERM_TERM = 'term';
    private const TERM_RANGE = 'range';
    private const QUERYSTRING = 'querystring';

    public function __invoke(Filter $filter): callable
    {
        $termLevel = $this->termLevelFor($filter->operator());
        return $this->getQueryBuilder($termLevel, $filter);
    }

    private function termLevelFor(FilterOperator $operator): string
    {
        return match ($operator->id()) {
            FilterOperator::EQUAL => self::TERM_TERM,
            FilterOperator::NOT_EQUAL => '!=',
            FilterOperator::GT, FilterOperator::LT, FilterOperator::LT_EQUAL => self::TERM_RANGE,
            FilterOperator::CONTAINS, FilterOperator::NOT_CONTAINS => self::QUERYSTRING,
            FilterOperator::IN => self::MUST_TYPE,
            default => throw new \Exception("Unexpected match value {$operator->id()}"),
        };
    }

    private function getQueryBuilder(string $operator, Filter $filter): callable
    {
        $query = [
            self::QUERYSTRING => function (BoolQuery $query) use ($filter): BoolQuery {
                $queryString = new QueryString();

                /** @var string $preparedSearch */
                $preparedSearch = $this->prepareSearchText($filter->value()->value());

                $queryString->setQuery($preparedSearch);
                $query->addMust($queryString);

                // Set specific fields to search
                $fields = $filter->fields()?->value();
                if (!empty($fields)) {
                    /** @var array $fields */
                    $queryString->setFields($fields);
                }

                return $query;
            },
            self::MUST_TYPE => function (BoolQuery $query) use ($filter): BoolQuery {
                $statusTerm = new Terms($filter->field()->value(), $filter->value()->value());
                $query->addMust($statusTerm);

                return $query;
            },
            self::TERM_TERM => function (BoolQuery $query) use ($filter): BoolQuery {
                $fieldQuery = new Term();
                $fieldQuery->setParam($filter->field()->value(), $filter->value()->value());
                $query->addMust($fieldQuery);

                return $query;
            },
        ];

        return $query[$operator];
    }
}