<?php

declare(strict_types=1);

namespace App\Magazine\Application\Index\GetAll;

use App\Magazine\Domain\Bus\Query\Response;
use App\Magazine\Domain\Bus\Query\QueryHandler;
use App\Magazine\Application\Index\GetAll\IndexGetAll;
use App\Magazine\Application\Index\GetAll\IndexGetAllQuery;
use App\Magazine\Application\Index\GetAll\IndexGetAllResponse;

final class IndexGetAllQueryHandler implements QueryHandler
{
    private IndexGetAll $service;

    public function __construct(IndexGetAll $service)
    {
        $this->service = $service;
    }

    public function __invoke(IndexGetAllQuery $query): Response
    {
        $data = [];
        $records = $this->service->__invoke();

        $dataIndex = $records['data']['hits']['hits'];

        foreach ($dataIndex as $index) {
            $id = $index['_id'];
            $record = $index['_source'];

            $data[] = [
                'id' => $id,
                'title' => $record['title'],
                'content' => $record['content'],
            ];
        }

        return new IndexGetAllResponse($data);
    }
}
