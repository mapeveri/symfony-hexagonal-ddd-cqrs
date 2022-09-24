<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class StringValueObject
{
    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}