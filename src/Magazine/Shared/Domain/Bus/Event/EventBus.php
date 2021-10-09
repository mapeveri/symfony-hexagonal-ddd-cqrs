<?php

declare(strict_types=1);

namespace App\Magazine\Shared\Domain\Bus\Event;

use App\Magazine\Shared\Domain\Bus\Event\Event;

interface EventBus
{
    public function publish(Event ...$events): void;
}
