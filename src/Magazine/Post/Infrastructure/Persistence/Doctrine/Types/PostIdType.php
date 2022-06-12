<?php

declare(strict_types=1);

namespace App\Magazine\Post\Infrastructure\Persistence\Doctrine\Types;

use App\Magazine\Post\Domain\ValueObjects\PostId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class PostIdType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;

        }
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?PostId
    {
        if (null === $value) {
            return null;
        }

        return PostId::create($value);
    }
}