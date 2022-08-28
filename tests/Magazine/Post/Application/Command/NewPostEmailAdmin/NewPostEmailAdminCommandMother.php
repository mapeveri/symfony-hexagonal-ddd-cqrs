<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Post\Application\Command\NewPostEmailAdmin;

use App\Magazine\Post\Application\Command\NewPostEmailAdmin\NewPostEmailAdminCommand;
use App\Tests\Shared\Domain\ValueObjects\DuplicatorMother;
use App\Tests\Shared\Utils\Faker\Faker;

final class NewPostEmailAdminCommandMother
{
    public static function create(?array $fields = null): NewPostEmailAdminCommand
    {
        $command = new NewPostEmailAdminCommand(
            Faker::random()->uuid,
            Faker::random()->title,
            Faker::random()->text,
        );

        if (null !== $fields) {
            $command = DuplicatorMother::with($command, $fields);
        }

        return $command;
    }
}