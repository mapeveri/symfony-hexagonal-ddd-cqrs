<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Bus\Event;

use App\Magazine\Domain\Event\DomainEvent;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}
