<?php

declare(strict_types=1);

namespace App\Magazine\Domain\User;

use App\Magazine\Domain\Entity\User;
use App\Magazine\Domain\User\UserAlreadyExist;

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
