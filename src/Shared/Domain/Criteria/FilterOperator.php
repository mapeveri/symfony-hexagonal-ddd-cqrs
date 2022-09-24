<?php

declare(strict_types=1);

namespace App\Shared\Domain\Criteria;

use App\Shared\Domain\ValueObject\Enum;
use InvalidArgumentException;

final class FilterOperator extends Enum
{
    public const EQUAL        = '=';
    public const NOT_EQUAL    = '<>';
    public const GT           = '>';
    public const LT           = '<';
    public const LT_EQUAL     = '<=';
    public const IN           = 'IN';
    public const CONTAINS     = 'CONTAINS';
    public const NOT_CONTAINS = 'NOT_CONTAINS';

    private static array $containing = [self::CONTAINS, self::NOT_CONTAINS];

    public static function validValues(): array
    {
        return [
            self::EQUAL,
            self::NOT_EQUAL,
            self::GT,
            self::LT,
            self::IN,
            self::CONTAINS,
            self::NOT_CONTAINS,
            self::LT_EQUAL,
        ];
    }

    public function isContaining(): bool
    {
        return in_array($this->id(), self::$containing, true);
    }

    protected function throwExceptionForInvalidValue(mixed $value): void
    {
        throw new InvalidArgumentException(sprintf('The filter <%s> is invalid', $value));
    }
}