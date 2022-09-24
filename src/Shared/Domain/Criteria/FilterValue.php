<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class FilterValue
{
    public function __construct(private mixed $value)
    {
    }

    public function value(): mixed
    {
        return $this->value;
    }
}