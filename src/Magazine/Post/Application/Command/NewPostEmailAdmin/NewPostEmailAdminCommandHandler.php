<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Command\NewPostEmailAdmin;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class NewPostEmailAdminCommandHandler implements CommandHandler
{
    private NewPostEmailAdmin $service;

    public function __construct(NewPostEmailAdmin $service)
    {
        $this->service = $service;
    }

    public function __invoke(NewPostEmailAdminCommand $command): void
    {
        $this->service->__invoke(
            $command->id(),
            $command->title(),
            $command->content()
        );
    }
}
