<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Event\Create;

use App\Magazine\Category\Domain\Events\CategoryWasCreatedEvent;
use App\Shared\Domain\Bus\Event\EventHandler;
use Psr\Log\LoggerInterface;

final class LogCategoryOnCategoryWasCreatedEventHandler implements EventHandler
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(CategoryWasCreatedEvent $event): void
    {
        $this->logger->info(sprintf('Category was created with title: %s ', $event->name()));
    }
}