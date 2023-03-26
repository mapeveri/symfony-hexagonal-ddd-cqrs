<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Command\NewPostEmailAdmin;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class NewPostEmailAdminCommandHandler implements CommandHandler
{
    private NewPostEmailSender $service;

    public function __construct(NewPostEmailSender $service)
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
