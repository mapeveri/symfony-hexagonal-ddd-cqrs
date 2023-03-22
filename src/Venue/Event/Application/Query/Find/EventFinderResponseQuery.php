<?php

declare(strict_types=1);

namespace App\Venue\Event\Application\Query\Find;

use App\Shared\Domain\Bus\Query\Query;

final class EventFinderResponseQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}