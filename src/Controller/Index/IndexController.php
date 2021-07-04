<?php

declare(strict_types=1);

namespace App\Controller\Index;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Index\GetAll\IndexGetAllQuery;

final class IndexController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        $response = $this->handle(new IndexGetAllQuery());

        return new JsonResponse($response->data());
    }
}
