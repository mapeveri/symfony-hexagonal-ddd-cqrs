<?php

namespace App\Controller\Category;

use App\Magazine\Category\Application\Query\Find\CategoryFinderResponseQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CategoryFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        $response = $this->handle(new CategoryFinderResponseQuery($id));

        return new JsonResponse($response->data());
    }
}
