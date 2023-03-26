<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Update;

use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CategoryUpdateHandler implements CommandHandler
{
    public function __construct(private CategoryUpdater $service)
    {
    }

    public function __invoke(CategoryUpdateCommand $command): void
    {
        $this->service->__invoke(
            CategoryId::create($command->id()),
            $command->name(),
            $command->description(),
            CategoryId::create($command->parent()),
            $command->hidden()
        );
    }
}
