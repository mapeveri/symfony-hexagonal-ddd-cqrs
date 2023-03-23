<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Command\Update;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class EventUpdateCommandHandler implements CommandHandler
{
    public function __construct(private EventUpdate $service)
    {
    }

    public function __invoke(EventUpdateCommand $command): void
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
