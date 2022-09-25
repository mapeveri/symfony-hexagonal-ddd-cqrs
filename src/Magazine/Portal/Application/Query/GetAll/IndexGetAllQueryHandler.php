<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Query\GetAll;

use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Bus\Query\QueryHandler;

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
        $records = $this->service->__invoke($query->search(), $query->ids());

        if (count($records) > 0) {
            $dataIndex = $records['data']['hits']['hits'];

            foreach ($dataIndex as $index) {
                $record = $index['_source'];

                $data[] = [
                    'id' => $record['id'],
                    'title' => $record['title'],
                    'content' => $record['content'],
                ];
            }
        }

        return new IndexGetAllResponse($data);
    }
}
