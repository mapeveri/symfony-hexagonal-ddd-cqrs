<?php

declare(strict_types=1);

namespace App\Controller\Venue\Comment;

use App\Shared\Infrastructure\Ports\ApiController;
use App\Venue\Comment\Application\Create\CommentCreateCommand;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CommentPostController extends ApiController
{
    public function __invoke(Request $request, string $eventId): JsonResponse
    {
        $content = $request->getContent();

        if (empty($content)) {
            throw new RuntimeException('The body is empty');
        }

        try {
            $params = json_decode($content, true);
            $this->dispatch(new CommentCreateCommand(
                $eventId,
                $params['content'],
                $params['username'],
            ));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
