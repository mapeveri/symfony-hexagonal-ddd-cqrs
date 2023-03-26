<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Command\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class EventCreateCommandHandler implements CommandHandler
{
    public function __construct(private EventCreator $service)
    {
    }

    public function __invoke(EventCreateCommand $command): void
    {
        $this->service->__invoke(
            $command->id(),
            $command->title(),
            $command->content(),
            $command->location(),
            $command->startAt(),
            $command->endAt()
        );
    }
}
