<?php

declare(strict_types=1);

namespace App\Magazine\User\Application\Query\Find;

use App\Magazine\User\Domain\UserFinderExists as DomainUserFinderExists;
use App\Magazine\User\Domain\User;
use App\Magazine\User\Domain\UserRepository;

final class UserFinderExists
{
    private DomainUserFinderExists $finder;

    public function __construct(UserRepository $repository)
    {
        $this->finder = new DomainUserFinderExists($repository);
    }

    public function __invoke(string $username): ?User
    {
        return $this->finder->__invoke($username);
    }
}
