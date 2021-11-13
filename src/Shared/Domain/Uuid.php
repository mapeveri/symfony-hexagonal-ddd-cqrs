<?php

namespace App\Shared\Domain;

use Symfony\Component\Uid\Uuid as SymfonyUuid;

final class Uuid
{
    public static function next(): string
    {
        return SymfonyUuid::v4();
    }
}