<?php

namespace App\Controller\Category;

use App\Magazine\Category\Application\Command\Update\CategoryUpdateCommand;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use RuntimeException;

final class CategoryPutController extends ApiController
{
    public function __invoke(Request $request, string $id): Response
    {
        $content = $request->getContent();

        if (empty($content)) {
            throw new RuntimeException('The body is empty');
        }

        $params = json_decode($content, true);

        $this->dispatch(new CategoryUpdateCommand(
            $id,
            $params['name'],
            $params['description'],
            $params['parent'],
            $params['hidden'],
        ));

        return new Response('', Response::HTTP_OK);
    }
}
