<?php

declare(strict_types=1);

namespace App\Magazine\Application\User\Create;

use App\Magazine\Shared\Domain\Bus\Command\CommandHandler;
use App\Magazine\Application\User\Create\UserCreate;
use App\Magazine\Application\User\Create\UserCreateCommand;

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
