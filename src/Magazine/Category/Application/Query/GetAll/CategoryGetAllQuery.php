<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\GetAll;

use App\Shared\Domain\Bus\Query\Query;

final class CategoryGetAllQuery implements Query
{
    public function __construct(private ?string $name, private ?bool $hidden)
    {
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function hidden(): ?bool
    {
        return $this->hidden;
    }


}
