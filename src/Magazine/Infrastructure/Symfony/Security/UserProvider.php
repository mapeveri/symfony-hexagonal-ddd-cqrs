<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Symfony\Security;

use App\Magazine\Domain\User\UserRepository;
use App\Magazine\Infrastructure\Symfony\Security\Auth;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function loadUserByUsername($username): Auth
    {
        $user = $this->repository->findByUsername($username);

        if (!$user) {
            throw new UsernameNotFoundException();
        }

        return new Auth($username, $user->getPassword());
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool
    {
        return Auth::class === $class;
    }
}
