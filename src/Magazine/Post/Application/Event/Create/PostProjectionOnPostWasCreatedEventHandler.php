<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Event\Create;

use App\Magazine\Portal\Domain\PortalRepository;
use App\Magazine\Post\Application\Command\NewPostEmailAdmin\NewPostEmailAdminCommand;
use App\Magazine\Post\Domain\PostWasCreatedEvent;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Event\EventHandler;

final class PostProjectionOnPostWasCreatedEventHandler implements EventHandler
{
    private CommandBus $commandBus;
    private PortalRepository $repository;

    public function __construct(CommandBus $commandBus, PortalRepository $repository)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }

    public function __invoke(PostWasCreatedEvent $event): void
    {
        $this->repository->add(
            $event->id(), 
            ['id' => $event->id(), 'title' => $event->title(), 'content' => $event->content()]
        );

        $this->commandBus->dispatch(
            new NewPostEmailAdminCommand(
                $event->id(),
                $event->title(),
                $event->content()
            )
        );
    }
}
