<?php

namespace App\Controller\Category;

use App\Magazine\Category\Application\Query\GetAll\CategoryGetAllQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CategoryAllController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        $response = $this->handle(new CategoryGetAllQuery());

        return new JsonResponse($response->data());
    }
}
