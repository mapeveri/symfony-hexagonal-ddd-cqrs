<?php

declare(strict_types=1);

namespace App\Venue\Comment\Application\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class CommentCreateCommandHandler implements CommandHandler
{
    public function __construct(private CommentCreator $service)
    {
    }

    public function __invoke(CommentCreateCommand $command): void
    {
        $this->service->__invoke($command->eventId(), $command->content(), $command->username());
    }
}
