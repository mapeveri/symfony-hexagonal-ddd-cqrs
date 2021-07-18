<?php

namespace App\Controller\Category;

use Symfony\Component\HttpFoundation\Response;
use App\Magazine\Infrastructure\Symfony\ApiController;
use App\Magazine\Application\Category\Delete\CategoryDeleteCommand;

final class CategoryDeleteController extends ApiController
{
    public function __invoke(int $id): Response
    {
        $this->dispatch(new CategoryDeleteCommand($id));

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
