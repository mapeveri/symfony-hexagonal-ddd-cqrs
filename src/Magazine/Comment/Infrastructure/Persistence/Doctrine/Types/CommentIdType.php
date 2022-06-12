<?php

declare(strict_types=1);

namespace App\Magazine\Comment\Infrastructure\Persistence\Doctrine\Types;

use App\Magazine\Comment\Domain\ValueObjects\CommentId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class CommentIdType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;

        }
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?CommentId
    {
        if (null === $value) {
            return null;
        }

        return CommentId::create($value);
    }
}