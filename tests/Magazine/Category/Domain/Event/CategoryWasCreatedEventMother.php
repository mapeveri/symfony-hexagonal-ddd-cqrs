<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Domain\Event;

use App\Magazine\Category\Domain\Event\CategoryWasCreatedEvent;
use App\Tests\Magazine\Shared\Domain\ValueObjects\DuplicatorMother;
use App\Tests\Magazine\Shared\Utils\Faker\Faker;

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