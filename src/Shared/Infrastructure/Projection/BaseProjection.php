<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Projection;

use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\Projection\Projection;
use App\Shared\Domain\Utils;

abstract class BaseProjection implements Projection
{
    public function project(EventStream $eventStream)
    {
        foreach ($eventStream as $event) {
            $projectMethod = 'project' . Utils::shortNamespace(get_class($event));
            $this->$projectMethod($event);
        }
    }
}
