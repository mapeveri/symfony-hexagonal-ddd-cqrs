<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Delete;

use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CategoryDeleteCommandHandler implements CommandHandler
{
    private CategoryDeleter $service;

    public function __construct(CategoryDeleter $service)
    {
        $this->service = $service;
    }

    public function __invoke(CategoryDeleteCommand $command): void
    {
        $this->service->__invoke(CategoryId::create($command->id()));
    }
}
