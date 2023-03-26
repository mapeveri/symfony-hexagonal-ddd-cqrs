<?php

declare(strict_types=1);

namespace App\Controller\Magazine\Index;

use App\Magazine\Portal\Application\Query\GetAll\IndexGetAllQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class IndexController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $search = null === $request->query->get('search') ? null : (string)$request->query->get('search');
        $ids = null === $request->query->get('ids') ? null : (array)$request->query->get('ids');
        $response = $this->handle(new IndexGetAllQuery($search, $ids));

        return new JsonResponse($response->data());
    }
}
