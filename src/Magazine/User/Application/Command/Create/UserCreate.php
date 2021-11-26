<?php

declare(strict_types=1);

namespace App\Magazine\User\Application\Command\Create;

use App\Magazine\User\Application\Query\Find\UserFinderExists;
use App\Magazine\User\Domain\GeneratePassword;
use App\Magazine\User\Domain\User;
use App\Magazine\User\Domain\UserRepository;
use App\Shared\Domain\Uuid;

final class UserCreate
{
    private UserRepository $repository;
    private UserFinderExists $serviceFinderExists;
    private GeneratePassword $generatePassword;

    public function __construct(
        UserRepository $repository,
        UserFinderExists $serviceFinderExists,
        GeneratePassword $generatePassword
    ) {
        $this->repository = $repository;
        $this->serviceFinderExists = $serviceFinderExists;
        $this->generatePassword = $generatePassword;
    }

    public function __invoke(string $username, string $email, string $password, bool $isActive): void
    {
        // Throw exception if the user exists
        $this->serviceFinderExists->__invoke($username);

        $user = User::create(
            Uuid::next(),
            $username,
            $email,
            $password,
            $isActive
        );

        // Encoded password
        $encodedPassword = $this->generatePassword->generate($user, $password);
        $user->setPassword($encodedPassword);

        // Save user
        $this->repository->save($user);
    }
}