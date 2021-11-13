<?php

namespace App\Controller\Post;

use App\Magazine\Post\Application\Query\Find\PostFinderQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PostFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        $response = $this->handle(new PostFinderQuery($id));

        return new JsonResponse($response->data());
    }
}
