<?php

namespace App\Controller\Magazine\Category;

use App\Magazine\Category\Application\Command\Update\CategoryUpdateCommand;
use App\Shared\Infrastructure\Ports\ApiController;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CategoryPutController extends ApiController
{
    public function __invoke(Request $request, string $id): Response
    {
        $content = $request->getContent();

        if (empty($content)) {
            throw new RuntimeException('The body is empty');
        }

        try {
            $params = json_decode($content, true);
            $this->dispatch(new CategoryUpdateCommand(
                $id,
                $params['name'],
                $params['description'],
                $params['parent'],
                $params['hidden'],
            ));
        } catch(\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], Response::HTTP_OK);
    }
}
