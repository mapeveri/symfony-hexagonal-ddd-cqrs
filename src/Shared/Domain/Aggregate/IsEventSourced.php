<?php

declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;

interface IsEventSourced
{
    public static function reconstituteFrom(AggregateHistory $aggregateHistory): self;
}