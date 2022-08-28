<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Domain;

use App\Magazine\Category\Domain\Category;
use App\Tests\Magazine\Category\Domain\ValueObjects\CategoryIdMother;
use App\Tests\Shared\Domain\ValueObjects\DuplicatorMother;
use App\Tests\Shared\Utils\Faker\Faker;

final class CategoryMother
{
    public static function create(?array $overrideFields = null): Category
    {
        $category = new Category(
            CategoryIdMother::create(),
            Faker::random()->name(),
            Faker::random()->text(),
            null,
            Faker::random()->boolean()
        );

        if (null !== $overrideFields) {
            return DuplicatorMother::with($category, $overrideFields);
        }

        return $category;
    }
}