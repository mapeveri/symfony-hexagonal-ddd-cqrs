<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Update;

use App\Magazine\Shared\Domain\Bus\Command\CommandHandler;
use App\Magazine\Application\Category\Update\CategoryUpdate;
use App\Magazine\Application\Category\Update\CategoryUpdateCommand;

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
