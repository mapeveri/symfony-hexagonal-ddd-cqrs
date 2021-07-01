<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\GetAll;

use App\Magazine\Domain\Bus\Query\Response;
use App\Magazine\Domain\Bus\Query\QueryHandler;
use App\Magazine\Application\Category\GetAll\CategoryGetAllQuery;
use App\Magazine\Application\Category\GetAll\CategoryGetAllResponse;

final class CategoryGetAllQueryHandler implements QueryHandler
{
    private $service;

    public function __construct(CategoryGetAll $service)
    {
        $this->service = $service;
    }

    public function __invoke(CategoryGetAllQuery $query): Response
    {
        $data = [];
        $records = $this->service->__invoke();

        foreach ($records as $record) {
            $parent = $record->parent();
            $data[] = [
                'id' => $record->id(),
                'name' => $record->name(),
                'description' => $record->description(),
                'hidden' => $record->hidden(),
                'parent' => ($parent ? $parent->id() : null),
            ];
        }

        return new CategoryGetAllResponse($data);
    }
}
