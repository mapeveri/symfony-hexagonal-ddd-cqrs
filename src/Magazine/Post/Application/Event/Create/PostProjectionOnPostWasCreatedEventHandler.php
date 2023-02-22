<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Event\Create;

use App\Magazine\Portal\Application\Command\Create\CreatePortalPostCommand;
use App\Magazine\Post\Domain\Events\PostWasCreatedEvent;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class PostProjectionOnPostWasCreatedEventHandler implements DomainEventSubscriber
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(PostWasCreatedEvent $event): void
    {
        $this->commandBus->dispatch(
            new CreatePortalPostCommand(
                $event->aggregateId(),
                ['title' => $event->title(), 'content' => $event->content()]
            )
        );
    }

    public static function subscribedTo(): array
    {
        return [
            PostWasCreatedEvent::class,
        ];
    }
}
