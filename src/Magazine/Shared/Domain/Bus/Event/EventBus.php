<?php

declare(strict_types=1);

namespace App\Magazine\Shared\Domain\Bus\Event;

use App\Magazine\Shared\Domain\Event\DomainEvent;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}
