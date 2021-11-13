<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Query\Find;

use App\Shared\Domain\Bus\Query\Query;

final class PostFinderQuery implements Query
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
