<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\EventStream\EventStream;

class AggregateRoot
{
    private array $domainEvents = [];

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->clearRecordedEvents();

        return $domainEvents;
    }

    final public function getRecordedEvents(): EventStream
    {
        return new EventStream($this->domainEvents);
    }

    final public function clearRecordedEvents(): void
    {
        $this->domainEvents = [];
    }

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}
