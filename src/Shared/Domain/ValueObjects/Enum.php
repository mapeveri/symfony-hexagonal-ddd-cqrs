<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use InvalidArgumentException;

abstract class Enum
{
    protected string $enum;

    final public function __construct(string $enum)
    {
        if (static::shouldValidate()){
            $this->validate($enum);
        }

        $this->enum = $enum;
    }

    public static function create(string $value): static
    {
        return new static($value);
    }

    public static function createOrNull(?string $value): ?static
    {
        if (null === $value) {
            return null;
        }

        return new static($value);
    }

    public static function shouldValidate(): bool
    {
        return true;
    }

    private function validate(string $enum): void
    {
        if (!in_array($enum, $this->validValues())) {
            throw new InvalidArgumentException(
                sprintf(
                    "class [%s] the provided value <'%s'> is not correct only allowed: <'%s'>",
                    get_class($this),
                    $enum,
                    implode("', '", $this->validValues())
                )
            );
        }
    }

    abstract public static function validValues(): array;

    public function __toString(): string
    {
        return $this->enum;
    }

    public function equals(self $other) : bool
    {
        return $other instanceof static && $this->enum === $other->enum;
    }

    public function id(): string
    {
        return $this->enum;
    }

    public function toArray(): array
    {
        return (array)$this->enum;
    }
}