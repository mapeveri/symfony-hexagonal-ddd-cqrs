<?php

declare(strict_types=1);

namespace App\Shared\Domain\Projection;

use App\Shared\Domain\EventStream\EventStream;

interface Projection
{
    public function project(EventStream $eventStream);
}
