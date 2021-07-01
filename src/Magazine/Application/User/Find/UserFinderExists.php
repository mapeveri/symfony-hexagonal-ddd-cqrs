<?php

declare(strict_types=1);

namespace App\Magazine\Application\User\Find;

use App\Magazine\Domain\Entity\User;
use App\Magazine\Domain\User\UserFinderExists as DomainUserFinderExists;
use App\Magazine\Domain\User\UserRepository;

final class UserFinderExists
{
    private $finder;

    public function __construct(UserRepository $repository)
    {
        $this->finder = new DomainUserFinderExists($repository);
    }

    public function __invoke(string $username): ?User
    {
        return $this->finder->__invoke($username);
    }
}
