<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Create;

use App\Magazine\Domain\Bus\Command\CommandHandler;
use App\Magazine\Application\Category\Create\CategoryCreate;
use App\Magazine\Application\Category\Create\CategoryCreateCommand;

final class CategoryCreateCommandHandler implements CommandHandler
{
    private $service;

    public function __construct(CategoryCreate $service)
    {
        $this->service = $service;
    }

    public function __invoke(CategoryCreateCommand $command): void
    {
        $this->service->__invoke(
            $command->name(),
            $command->description(),
            $command->parent(),
            $command->hidden()
        );
    }
}
