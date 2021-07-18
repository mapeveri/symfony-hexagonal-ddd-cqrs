<?php

namespace App\Controller\Category;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Category\Update\CategoryUpdateCommand;

final class CategoryPutController extends ApiController
{
    public function __invoke(Request $request, int $id): Response
    {
        $content = $request->getContent();
        
        if (!empty($content)) {
            $params = json_decode($content, true);
        }

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
