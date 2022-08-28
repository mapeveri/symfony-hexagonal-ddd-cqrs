<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\Mockery;

use App\Tests\Shared\Infrastructure\PhpUnit\Constraint\AppConstraintIsSimilar;
use Mockery\Matcher\MatcherAbstract;

final class AppMatcherIsSimilar extends MatcherAbstract
{
    private AppConstraintIsSimilar $constraint;

    public function __construct($value, $delta = 0.0)
    {
        parent::__construct($value);

        $this->constraint = new AppConstraintIsSimilar($value, $delta);
    }

    public function match(&$actual): bool
    {
        return $this->constraint->evaluate($actual, '', true);
    }

    public function __toString(): string
    {
        return 'Is similar';
    }
}