<?php

namespace App\Controller\Magazine\Category;

use App\Magazine\Category\Application\Command\Delete\CategoryDeleteCommand;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CategoryDeleteController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        try {
            $this->dispatch(new CategoryDeleteCommand($id));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
