<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class CategoryCreateCommandHandler implements CommandHandler
{
    private CategoryCreator $service;

    public function __construct(CategoryCreator $service)
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
