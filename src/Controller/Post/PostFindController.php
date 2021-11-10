<?php

namespace App\Controller\Post;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Post\Find\PostFinderQuery;

final class PostFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        $response = $this->handle(new PostFinderQuery($id));

        return new JsonResponse($response->data());
    }
}
