<?php

declare(strict_types=1);

namespace App\Shared\Domain\Snapshot;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Snapshot
{
    public function __construct(private AggregateRoot $aggregate, private int $version)
    {
    }

    public function aggregate(): AggregateRoot
    {
        return $this->aggregate;
    }

    public function version(): int
    {
        return $this->version;
    }
}
