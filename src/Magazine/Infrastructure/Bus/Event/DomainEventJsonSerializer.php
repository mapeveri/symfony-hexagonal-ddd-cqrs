<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Bus\Event;

use App\Magazine\Domain\Event\DomainEvent;

final class DomainEventJsonSerializer
{
    public static function serialize(DomainEvent $domainEvent): string
    {
        return json_encode(
            [
                'data' => [
                    'id' => $domainEvent->eventId(),
                    'type' => $domainEvent::eventName(),
                    'class' => $domainEvent::eventClass(),
                    'occurred_on' => $domainEvent->occurredOn(),
                    'attributes'  => array_merge($domainEvent->toPrimitives(), ['id' => $domainEvent->id()]),
                ],
                'meta' => [],
            ]
        );
    }
}
