<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Post\Domain\Events;

use App\Magazine\Post\Domain\Events\PostWasCreatedEvent;
use App\Tests\Shared\Domain\ValueObjects\DuplicatorMother;
use App\Tests\Shared\Utils\Faker\Faker;

final class PostWasCreatedEventMother
{
    public static function create(?array $fields = null): PostWasCreatedEvent
    {
        $event = new PostWasCreatedEvent(
            Faker::random()->uuid,
            Faker::random()->title,
            Faker::random()->text,
            Faker::random()->uuid,
            Faker::random()->uuid,
            Faker::random()->boolean,
        );

        if (null !== $fields) {
            $event = DuplicatorMother::with($event, $fields);
        }

        return $event;
    }
}