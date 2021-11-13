<?php

declare(strict_types=1);

namespace App\Shared\Domain\Bus\Event;

use App\Shared\Domain\Bus\Event\Event;

interface EventBus
{
    public function publish(Event ...$events): void;
}
