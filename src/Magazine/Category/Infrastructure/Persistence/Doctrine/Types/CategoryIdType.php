<?php

declare(strict_types=1);

namespace App\Magazine\Category\Infrastructure\Persistence\Doctrine\Types;

use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class CategoryIdType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;

        }
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?CategoryId
    {
        if (null === $value) {
            return null;
        }

        return CategoryId::create($value);
    }
}