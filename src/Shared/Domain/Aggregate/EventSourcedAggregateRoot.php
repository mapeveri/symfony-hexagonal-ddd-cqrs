<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\Utils;

abstract class EventSourcedAggregateRoot extends AggregateRoot
{
    public abstract static function reconstituteFrom(EventStream $eventStream): EventSourcedAggregateRoot;

    final protected function apply(DomainEvent $anEvent): void
    {
        $method = 'apply' . Utils::shortNamespace($anEvent::class);
        $this->$method($anEvent);
    }

    public function replay(EventStream $eventStream): void
    {
        /** @var DomainEvent */
        foreach ($eventStream as $event) {
            $this->apply($event);
        }
    }
}
