<?php

namespace App\Controller\Category;

use App\Magazine\Category\Application\Command\Create\CategoryCreateCommand;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use RuntimeException;

final class CategoryPostController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $content = $request->getContent();
        
        if (empty($content)) {
            throw new RuntimeException('The body is empty');
        }

        try {
            $params = json_decode($content, true);
            $this->dispatch(new CategoryCreateCommand(
                $params['name'],
                $params['description'],
                $params['parent'],
                $params['hidden'],
            ));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
