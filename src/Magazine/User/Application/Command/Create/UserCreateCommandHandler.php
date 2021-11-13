<?php

declare(strict_types=1);

namespace App\Magazine\User\Application\Command\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class UserCreateCommandHandler implements CommandHandler
{
    private UserCreate $service;

    public function __construct(UserCreate $service)
    {
        $this->service = $service;
    }

    public function __invoke(UserCreateCommand $command): void
    {
        $this->service->__invoke(
            $command->username(),
            $command->email(),
            $command->password(),
            $command->isActive()
        );
    }
}
