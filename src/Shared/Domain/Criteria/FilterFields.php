<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

final class FilterFields
{
    public function __construct(private array $valueObjects)
    {
    }

    public function value(): array
    {
        return $this->valueObjects;
    }
}