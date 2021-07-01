<?php

declare(strict_types=1);

namespace App\Magazine\Application\User\Create;

use App\Magazine\Domain\Bus\Command\CommandHandler;
use App\Magazine\Application\User\Create\UserCreate;
use App\Magazine\Application\User\Create\UserCreateCommand;

final class UserCreateCommandHandler implements CommandHandler
{
    private $service;

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
