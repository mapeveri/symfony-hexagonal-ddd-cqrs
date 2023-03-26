<?php

namespace App\Controller\Magazine\Post;

use App\Magazine\Post\Application\Query\Find\PostFinderQuery;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class PostFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        try {
            $response = $this->handle(new PostFinderQuery($id));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($response->data());
    }
}
