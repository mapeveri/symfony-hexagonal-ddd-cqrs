<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class CategoryWasCreatedEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private string $name,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'category.created';
    }

    public static function eventClass(): string
    {
        return self::class;
    }

    public static function fromPrimitives(
        string $id,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self(
            $id,
            $body['name'],
            $eventId,
            $occurredOn);
    }

    public function toPrimitives(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public function name(): string
    {
        return $this->name;
    }
}