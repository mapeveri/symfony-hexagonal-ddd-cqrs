<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure;

use App\Shared\Domain\UuidGenerator;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

final class SymfonyUuidGenerator implements UuidGenerator
{
    public function generate(): string
    {
        return (string)SymfonyUuid::v4();
    }
}