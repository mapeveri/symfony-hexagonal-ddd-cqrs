<?php

declare(strict_types=1);

namespace App\Magazine\Application\Notification\NewPostEmailAdmin;

use App\Magazine\Domain\Bus\Command\CommandHandler;
use App\Magazine\Application\Notification\NewPostEmailAdmin\NewPostEmailAdmin;
use App\Magazine\Application\Notification\NewPostEmailAdmin\NewPostEmailAdminCommand;

final class NewPostEmailAdminCommandHandler implements CommandHandler
{
    private NewPostEmailAdmin $service;

    public function __construct(NewPostEmailAdmin $service)
    {
        $this->service = $service;
    }

    public function __invoke(NewPostEmailAdminCommand $command): void
    {
        $this->service->__invoke($command->title(), $command->content());
    }
}
