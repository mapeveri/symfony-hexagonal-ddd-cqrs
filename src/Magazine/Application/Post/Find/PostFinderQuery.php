<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Find;

use App\Magazine\Domain\Bus\Query\Query;

final class PostFinderQuery implements Query
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}
