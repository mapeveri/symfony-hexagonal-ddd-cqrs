<?php

declare(strict_types=1);

namespace App\Tests\Shared\Domain\ValueObjects;

use ReflectionObject;
use ReflectionProperty;
use function Lambdish\Phunctional\each;

final class DuplicatorMother
{
    public static function with($object, array $newParams)
    {
        $duplicated = clone $object;
        $reflection = new ReflectionObject($duplicated);

        each(
            static function (ReflectionProperty $property) use ($duplicated, $newParams) {
                if (array_key_exists($property->getName(), $newParams)) {
                    $property->setAccessible(true);
                    $property->setValue($duplicated, $newParams[$property->getName()]);
                }
            },
            $reflection->getProperties()
        );

        return $duplicated;
    }
}