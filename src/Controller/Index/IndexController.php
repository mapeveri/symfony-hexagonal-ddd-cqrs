<?php

declare(strict_types=1);

namespace App\Controller\Index;

use App\Magazine\Portal\Application\Query\GetAll\IndexGetAllQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class IndexController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        $response = $this->handle(new IndexGetAllQuery());

        return new JsonResponse($response->data());
    }
}
