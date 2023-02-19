<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Query\GetAll;

use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class IndexGetAllQueryHandler implements QueryHandler
{
    public function __construct(private IndexGetAll $service)
    {
    }

    public function __invoke(IndexGetAllQuery $query): Response
    {
        $data = [];
        $records = $this->service->__invoke($query->search(), $query->ids());

        if (count($records) === 0) {
            return new IndexGetAllResponse($data);
        }

        return new IndexGetAllResponse($records['data']);
    }
}
