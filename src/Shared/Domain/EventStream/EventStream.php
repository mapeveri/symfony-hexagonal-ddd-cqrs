<?php

declare(strict_types=1);

namespace App\Shared\Domain\EventStream;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Exceptions\ArrayIsImmutable;
use App\Shared\Domain\ValueObjects\ImmutableArray;

final class EventStream extends ImmutableArray
{
    protected function guardType(mixed $item): void
    {
        if(!($item instanceof DomainEvent)) {
            throw new ArrayIsImmutable;
        }
    }
}