<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Find;

use App\Magazine\Shared\Domain\Bus\Query\Query;

final class CategoryFinderQuery implements Query
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
