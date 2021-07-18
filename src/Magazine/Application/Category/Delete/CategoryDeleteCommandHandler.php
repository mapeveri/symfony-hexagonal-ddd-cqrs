<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Delete;

use App\Magazine\Shared\Domain\Bus\Command\CommandHandler;
use App\Magazine\Application\Category\Delete\CategoryDelete;
use App\Magazine\Application\Category\Delete\CategoryDeleteCommand;

final class CategoryDeleteCommandHandler implements CommandHandler
{
    private CategoryDelete $service;

    public function __construct(CategoryDelete $service)
    {
        $this->service = $service;
    }

    public function __invoke(CategoryDeleteCommand $command): void
    {
        $this->service->__invoke($command->id());
    }
}
