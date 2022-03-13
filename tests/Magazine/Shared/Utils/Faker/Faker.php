<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Shared\Utils\Faker;

use Faker\Factory;
use Faker\Generator;

final class Faker
{
    private static ?Generator $faker;

    public static function random(): Generator
    {
        return self::$faker = self::$faker ?? Factory::create();
    }
}