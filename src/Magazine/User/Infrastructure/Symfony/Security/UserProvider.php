<?php

declare(strict_types=1);

namespace App\Magazine\User\Infrastructure\Symfony\Security;

use App\Magazine\User\Domain\UserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUsername());
    }

    public function supportsClass($class): bool
    {
        return Auth::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->repository->findByUsername($identifier);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return new Auth($identifier, $user->getPassword());
    }
}
