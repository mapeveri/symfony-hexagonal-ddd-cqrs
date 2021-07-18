<?php

declare(strict_types=1);

namespace App\Magazine\Shared\Domain\Event;
use DateTimeImmutable;
use function uniqid;

abstract class DomainEvent
{
    private string $id;
    private string $eventId;
    private string $occurredOn;

    public function __construct(string $id, string $eventId = null, string $occurredOn = null)
    {
        $this->id = $id;
        $this->eventId = $eventId ?: uniqid();
        $this->occurredOn = $occurredOn ?: date("Y-m-d H:i:s");
    }

    abstract public static function fromPrimitives(
        string $id,
        array $body,
        string $eventId,
        string $occurredOn
    ): self;

    abstract public static function eventName(): string;

    abstract public static function eventClass(): string;

    abstract public function toPrimitives(): array;

    public function id(): string
    {
        return $this->id;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }
}