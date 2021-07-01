<?php

namespace App\Controller\Category;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Category\Create\CategoryCreateCommand;

final class CategoryPostController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        $content = $request->getContent();
        
        if (!empty($content)) {
            $params = json_decode($content, true);
        }

        $this->dispatch(new CategoryCreateCommand(
            $params['name'],
            $params['description'],
            $params['parent'],
            $params['hidden'],
        ));

        return new Response('', Response::HTTP_CREATED);
    }
}
