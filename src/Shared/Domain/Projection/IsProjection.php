<?php

declare(strict_types=1);

namespace App\Shared\Domain\Projection;

interface IsProjection
{
    public static function projectionName(): string;
}
