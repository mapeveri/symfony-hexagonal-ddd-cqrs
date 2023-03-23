<?php

declare(strict_types=1);

namespace App\Venue\Event\Domain;

use App\Shared\Domain\Projection\Projection;
use App\Venue\Event\Domain\Events\EventWasCreatedEvent;
use App\Venue\Event\Domain\Events\EventWasUpdatedEvent;

interface EventProjection extends Projection
{
    public function projectEventWasCreatedEvent(EventWasCreatedEvent $event): void;

    public function projectEventWasUpdatedEvent(EventWasUpdatedEvent $event): void;
}