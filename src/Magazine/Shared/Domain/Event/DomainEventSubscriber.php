<?php

declare(strict_types=1);

namespace App\Magazine\Shared\Domain\Event;

interface DomainEventSubscriber
{
    public static function subscribedTo(): array;
}
