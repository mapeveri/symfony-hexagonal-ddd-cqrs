<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain;

final class UserFinderExists
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $username): ?User
    {
        $user = $this->repository->findByUsername($username);

        if (null !== $user) {
            throw new UserAlreadyExist($username);
        }

        return $user;
    }
}
