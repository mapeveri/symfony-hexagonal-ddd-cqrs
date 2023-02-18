<?php

declare(strict_types=1);

namespace App\Tests\Shared\Infrastructure\PhpUnit\Constraint;

use App\Tests\Shared\Infrastructure\PhpUnit\Comparator\CommandSimilarComparator;
use App\Tests\Shared\Infrastructure\PhpUnit\Comparator\DomainEventArraySimilarComparator;
use App\Tests\Shared\Infrastructure\PhpUnit\Comparator\DomainEventSimilarComparator;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;
use SebastianBergmann\Comparator\Factory as ComparatorFactory;
use function str_contains;
use function is_string;
use function sprintf;

final class AppConstraintIsSimilar extends Constraint
{
    public function __construct(private $value, private float $delta = 0.0)
    {
    }

    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
    {
        if ($this->value === $other) {
            return true;
        }

        $isValid           = true;
        $comparatorFactory = ComparatorFactory::getInstance();

        $comparatorFactory->register(new DomainEventArraySimilarComparator());
        $comparatorFactory->register(new DomainEventSimilarComparator());

        try {
            $comparator = $comparatorFactory->getComparatorFor($this->value, $other);

            $comparator->assertEquals($this->value, $other, $this->delta);
        } catch (ComparisonFailure $f) {
            if (!$returnResult) {
                throw new ExpectationFailedException(
                    trim($description . "\n" . $f->getMessage()),
                    $f
                );
            }

            $isValid = false;
        }

        return $isValid;
    }

    public function toString(): string
    {
        $delta = '';

        if (is_string($this->value)) {
            if (str_contains($this->value, "\n")) {
                return 'is equal to <text>';
            }

            return sprintf(
                "is equal to '%s'",
                $this->value
            );
        }

        if ($this->delta != 0) {
            $delta = sprintf(
                ' with delta <%F>',
                $this->delta
            );
        }

        return sprintf(
            'is equal to %s%s',
            $this->exporter()->export($this->value),
            $delta
        );
    }
}