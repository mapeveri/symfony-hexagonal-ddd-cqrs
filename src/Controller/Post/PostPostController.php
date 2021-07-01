<?php

namespace App\Controller\Post;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Post\Create\PostCreateCommand;

final class PostPostController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        $content = $request->getContent();
        
        if (!empty($content)) {
            $params = json_decode($content, true);
        }

        $this->dispatch(new PostCreateCommand(
            $params['title'],
            $params['content'],
            $params['category_id'],
            $params['user_id'],
            $params['hidden'],
        ));

        return new Response('', Response::HTTP_CREATED);
    }
}
