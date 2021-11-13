<?php

namespace App\Controller\Category;

use App\Magazine\Category\Application\Command\Delete\CategoryDeleteCommand;
use App\Shared\Infrastructure\Ports\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class CategoryDeleteController extends ApiController
{
    public function __invoke(string $id): Response
    {
        $this->dispatch(new CategoryDeleteCommand($id));

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
