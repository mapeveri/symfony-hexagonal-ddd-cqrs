<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain\Services;

use App\Magazine\User\Domain\User;
use App\Magazine\User\Domain\UserRepository;
use App\Magazine\User\Domain\ValueObjects\UserId;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

final class UserFinder
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(UserId $id): ?User
    {
        $user = $this->repository->find($id);

        if (null === $user) {
            throw new UserNotFoundException($id->value());
        }

        return $user;
    }
}