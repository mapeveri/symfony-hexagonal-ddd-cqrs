<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Delete;

use App\Shared\Domain\Bus\Command\CommandHandler;

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
