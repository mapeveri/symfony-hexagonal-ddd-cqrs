<?php

namespace App\Controller\Category;

use App\Magazine\Category\Application\Query\GetAll\CategoryGetAllQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class CategoryAllController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $name = null === $request->query->get('name') ? null : $request->query->get('name');
        $hidden = null === $request->query->get('hidden') ? null : (bool)$request->query->get('hidden');
        $response = $this->handle(new CategoryGetAllQuery($name, $hidden));

        return new JsonResponse($response->data());
    }
}
