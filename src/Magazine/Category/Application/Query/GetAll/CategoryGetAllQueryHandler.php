<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\GetAll;

use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class CategoryGetAllQueryHandler implements QueryHandler
{
    private CategoryGetAll $service;

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
                'id' => $record->id()->value(),
                'name' => $record->name(),
                'description' => $record->description(),
                'hidden' => $record->hidden(),
                'parent' => ($parent ? $parent->id() : null),
            ];
        }

        return new CategoryGetAllResponse($data);
    }
}
