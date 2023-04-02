<?php

declare(strict_types=1);

namespace App\Shared\Domain\EventStream;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class EventStream implements \Iterator
{
    private string $aggregateId;
    /** @var DomainEvent[] $events */
    private array $events;

    /**
     * @param string $aggregateId
     * @param DomainEvent[] $events
     */
    public function __construct(string $aggregateId, array $events)
    {
        $this->aggregateId = $aggregateId;
        $this->events = $events;
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function rewind(): void
    {
        reset($this->events);
    }

    public function current(): mixed
    {
        return current($this->events);
    }

    public function key(): mixed
    {
        return key($this->events);
    }

    public function next(): void
    {
        next($this->events);
    }

    public function valid(): bool
    {
        return key($this->events) !== null;
    }
}
