<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Domain\ValueObjects;

use App\Magazine\Category\Domain\ValueObjects\CategoryId;

final class CategoryIdMother
{
    public static function create(): CategoryId
    {
        return CategoryId::random();
    }
}