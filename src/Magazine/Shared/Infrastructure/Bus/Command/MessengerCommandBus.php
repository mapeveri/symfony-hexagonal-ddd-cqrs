<?php

declare(strict_types=1);

namespace App\Magazine\Shared\Infrastructure\Bus\Command;

use App\Magazine\Shared\Domain\Bus\Command\Command;
use App\Magazine\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
