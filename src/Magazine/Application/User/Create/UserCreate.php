<?php

declare(strict_types=1);

namespace App\Magazine\Application\User\Create;

use App\Magazine\Domain\Entity\User;
use App\Magazine\Domain\User\UserRepository;
use App\Magazine\Domain\User\GeneratePassword;
use App\Magazine\Application\User\Find\UserFinderExists;

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

        $user = User::create($username, $email, $password, $isActive);

        // Encoded password
        $encodedPassword = $this->generatePassword->generate($user, $password);
        $user->setPassword($encodedPassword);

        // Save user
        $this->repository->save($user);
    }
}
