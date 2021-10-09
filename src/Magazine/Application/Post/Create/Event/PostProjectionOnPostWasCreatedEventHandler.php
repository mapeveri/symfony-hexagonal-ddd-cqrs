<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Create\Event;

use App\Magazine\Domain\Post\PostWasCreatedEvent;
use App\Magazine\Domain\Index\IndexRepository;
use App\Magazine\Shared\Domain\Bus\Command\CommandBus;
use App\Magazine\Shared\Domain\Bus\Event\EventHandler;
use App\Magazine\Application\Notification\NewPostEmailAdmin\NewPostEmailAdminCommand;

final class PostProjectionOnPostWasCreatedEventHandler implements EventHandler
{
    private CommandBus $commandBus;
    private IndexRepository $repository;

    public function __construct(CommandBus $commandBus, IndexRepository $repository)
    {
        $this->commandBus = $commandBus;
        $this->repository = $repository;
    }

    public function __invoke(PostWasCreatedEvent $event): void
    {
        $this->repository->add(
            $event->id(), 
            ['title' => $event->title(), 'content' => $event->content()]
        );

        $this->commandBus->dispatch(new NewPostEmailAdminCommand($event->title(), $event->content()));
    }
}
