<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\GetAll;

use App\Magazine\Category\Domain\Category;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Bus\Query\QueryHandler;
use function Lambdish\Phunctional\map;

final class CategoryGetAllQueryHandler implements QueryHandler
{
    public function __construct(private CategoryGetAll $service)
    {
    }

    public function __invoke(CategoryGetAllQuery $query): Response
    {
        $categories = $this->service->__invoke($query->name(), $query->hidden());
        $data = map(self::getCategory(), $categories);
        return new CategoryGetAllResponse($data);
    }

    private static function getCategory(): callable
    {
        return static fn(Category $category) => [
            'id' => $category->id()->value(),
            'name' => $category->name(),
            'description' => $category->description(),
            'hidden' => $category->hidden(),
            'parent' => ($category->parent() ? $category->parent()->id()->value() : null),
        ];
    }
}
