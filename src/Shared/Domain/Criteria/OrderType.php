<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\ValueObjects\Enum;
use InvalidArgumentException;

final class OrderType extends Enum
{
    public const ASC  = 'asc';
    public const DESC = 'desc';
    public const NONE = 'none';

    public static function validValues(): array
    {
        return [
            self::ASC,
            self::DESC,
            self::NONE
        ];
    }

    public static function asc(): self
    {
        return new self(self::ASC);
    }

    public static function desc(): self
    {
        return new self(self::DESC);
    }

    public static function none(): self
    {
        return new self(self::NONE);
    }

    public static function createOrDefault(?string $order): self
    {
        return new self($order ?? self::DESC);
    }

    public function isNone(): bool
    {
        return $this->equals(self::create(self::NONE));
    }

    protected function throwExceptionForInvalidValue(string $value): void
    {
        throw new InvalidArgumentException($value);
    }
}