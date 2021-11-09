<?php

namespace App\Controller\Category;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Category\Find\CategoryFinderQuery;

final class CategoryFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        $response = $this->handle(new CategoryFinderQuery($id));

        return new JsonResponse($response->data());
    }
}
