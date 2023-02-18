<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain\Services;

use App\Magazine\User\Domain\Exceptions\UserAlreadyExistException;
use App\Magazine\User\Domain\UserRepository;

final class UserFinderByUsernameChecker
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(string $username): void
    {
        $user = $this->repository->findByUsername($username);

        if (null !== $user) {
            throw new UserAlreadyExistException($username);
        }
    }
}
