<?php

namespace App\Controller\Magazine\Post;

use App\Magazine\Post\Application\Command\Create\PostCreateCommand;
use App\Shared\Infrastructure\Ports\ApiController;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPostController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        $content = $request->getContent();
        
        if (empty($content)) {
            throw new RuntimeException('The body is empty');
        }

        try {
            $params = json_decode($content, true);
            $this->dispatch(new PostCreateCommand(
                $params['title'],
                $params['content'],
                $params['category_id'],
                $params['user_id'],
                $params['hidden'],
            ));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
