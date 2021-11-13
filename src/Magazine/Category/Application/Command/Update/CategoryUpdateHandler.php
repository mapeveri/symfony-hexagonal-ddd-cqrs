<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Update;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class CategoryUpdateHandler implements CommandHandler
{
    private CategoryUpdate $service;

    public function __construct(CategoryUpdate $service)
    {
        $this->service = $service;
    }

    public function __invoke(CategoryUpdateCommand $command): void
    {
        $this->service->__invoke(
            $command->id(),
            $command->name(),
            $command->description(),
            $command->parent(),
            $command->hidden()
        );
    }
}
