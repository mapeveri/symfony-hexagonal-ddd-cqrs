<?php

namespace App\Controller\Category;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Category\GetAll\CategoryGetAllQuery;

final class CategoryAllController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        $response = $this->handle(new CategoryGetAllQuery());

        return new JsonResponse($response->data());
    }
}
