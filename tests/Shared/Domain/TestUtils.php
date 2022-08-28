<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain;

use App\Tests\Shared\Infrastructure\Mockery\AppMatcherIsSimilar;
use App\Tests\Shared\Infrastructure\PhpUnit\Constraint\AppConstraintIsSimilar;

final class TestUtils
{
    public static function isSimilar($expected, $actual): bool
    {
        $constraint = new AppConstraintIsSimilar($expected);

        return $constraint->evaluate($actual, '', true);
    }

    public static function similarTo($value, $delta = 0.0): AppMatcherIsSimilar
    {
        return new AppMatcherIsSimilar($value, $delta);
    }
}