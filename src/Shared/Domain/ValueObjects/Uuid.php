<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use InvalidArgumentException;
use Stringable;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class Uuid implements Stringable
{
    final public function __construct(private string $value)
    {
    }

    public static function create(?string $value): ?static
    {
        if (null === $value) {
            return null;
        }

        self::ensureIsValidUuid($value);

        return new static($value);
    }

    public static function random(): static
    {
        return new static((string)SymfonyUuid::v4());
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Uuid $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private static function ensureIsValidUuid(string $id): void
    {
        if (!SymfonyUuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }
}