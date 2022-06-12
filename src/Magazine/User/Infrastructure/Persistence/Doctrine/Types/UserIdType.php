<?php

declare(strict_types=1);

namespace App\Magazine\User\Infrastructure\Persistence\Doctrine\Types;

use App\Magazine\User\Domain\ValueObjects\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class UserIdType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;

        }

        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserId
    {
        if (null === $value) {
            return null;
        }

        return UserId::create($value);
    }
}