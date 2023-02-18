<?php

declare(strict_types=1);

namespace App\Magazine\User\Application\Command\Create;

use App\Magazine\User\Domain\GeneratePassword;
use App\Magazine\User\Domain\Services\UserFinderByUsernameChecker;
use App\Magazine\User\Domain\User;
use App\Magazine\User\Domain\UserRepository;
use App\Magazine\User\Domain\ValueObjects\UserId;
use App\Shared\Domain\UuidGenerator;

final class UserCreate
{
    public function __construct(
        private UserRepository              $repository,
        private UserFinderByUsernameChecker $serviceFinderByUsernameChecker,
        private GeneratePassword            $generatePassword,
        private UuidGenerator               $uuidGenerator
    ) {
    }

    public function __invoke(string $username, string $email, string $password, bool $isActive): void
    {
        $this->ensureUserDoesntExists($username);

        $user = User::create(
            UserId::Create($this->uuidGenerator->generate()),
            $username,
            $email,
            $password,
            $isActive
        );

        // Encoded password
        $encodedPassword = $this->generatePassword->generate($user, $password);
        $user->updatePassword($encodedPassword);

        // Save user
        $this->repository->save($user);
    }

    private function ensureUserDoesntExists(string $username): void
    {
        $this->serviceFinderByUsernameChecker->__invoke($username);
    }
}
