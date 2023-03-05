<?php

declare(strict_types=1);

namespace App\Controller\Event;

use App\Shared\Domain\ValueObjects\Uuid;
use App\Shared\Infrastructure\Ports\ApiController;
use App\Venue\Event\Application\Command\Create\EventCreateCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use RuntimeException;

final class EventPostController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $content = $request->getContent();

        if (empty($content)) {
            throw new RuntimeException('The body is empty');
        }

        try {
            $params = json_decode($content, true);
            $this->dispatch(new EventCreateCommand(
                Uuid::random()->value(),
                $params['title'],
                $params['content'],
                $params['location'],
                $params['start_at'],
                $params['end_at'],
            ));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
