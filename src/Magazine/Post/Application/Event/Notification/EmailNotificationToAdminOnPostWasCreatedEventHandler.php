<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Event\Notification;

use App\Magazine\Post\Application\Command\NewPostEmailAdmin\NewPostEmailAdminCommand;
use App\Magazine\Post\Domain\Event\PostWasCreatedEvent;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class EmailNotificationToAdminOnPostWasCreatedEventHandler implements DomainEventSubscriber
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(PostWasCreatedEvent $event): void
    {
        $this->commandBus->dispatch(
            new NewPostEmailAdminCommand(
                $event->aggregateId(),
                $event->title(),
                $event->content()
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