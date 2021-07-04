<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Event;

use App\Magazine\Domain\Event\DomainEvent;

trait EventsDomain {

    private array $domainEvents = [];

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
}