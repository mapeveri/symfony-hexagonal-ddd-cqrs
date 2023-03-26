<?php

namespace App\Controller\Magazine\Category;

use App\Magazine\Category\Application\Query\Find\CategoryFinderResponseQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CategoryFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        try {
            $response = $this->handle(new CategoryFinderResponseQuery($id));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($response->data());
    }
}
