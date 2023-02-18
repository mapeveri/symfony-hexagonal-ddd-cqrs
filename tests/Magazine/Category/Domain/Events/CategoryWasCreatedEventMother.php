<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Domain\Events;

use App\Magazine\Category\Domain\Events\CategoryWasCreatedEvent;
use App\Tests\Shared\Domain\ValueObjects\DuplicatorMother;
use App\Tests\Shared\Utils\Faker\Faker;

final class CategoryWasCreatedEventMother
{
    public static function create(?array $fields): CategoryWasCreatedEvent
    {
        $event = new CategoryWasCreatedEvent(Faker::random()->uuid, Faker::random()->title);

        if (null !== $fields) {
            $event = DuplicatorMother::with($event, $fields);
        }

        return $event;
    }
}