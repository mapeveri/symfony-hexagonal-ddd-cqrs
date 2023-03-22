<?php

declare(strict_types=1);

namespace App\Controller\Event;

use App\Shared\Infrastructure\Ports\ApiController;
use App\Venue\Event\Application\Query\Find\EventFinderResponseQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class EventFindController extends ApiController
{
    public function __invoke(string $id): JsonResponse
    {
        try {
            $response = $this->handle(new EventFinderResponseQuery($id));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($response?->data());
    }
}
