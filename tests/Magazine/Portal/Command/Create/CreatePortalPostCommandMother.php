<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Portal\Command\Create;

use App\Magazine\Portal\Application\Command\Create\CreatePortalPostCommand;
use App\Tests\Magazine\Shared\Domain\ValueObjects\DuplicatorMother;
use App\Tests\Magazine\Shared\Utils\Faker\Faker;

final class CreatePortalPostCommandMother
{
    public static function create(?array $fields = null): CreatePortalPostCommand
    {
        $command = new CreatePortalPostCommand(
            Faker::random()->uuid,
            [],
        );

        if (null !== $fields) {
            $command = DuplicatorMother::with($command, $fields);
        }

        return $command;
    }
}