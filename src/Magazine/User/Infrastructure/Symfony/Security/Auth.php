<?php

declare(strict_types=1);

namespace App\Magazine\User\Infrastructure\Symfony\Security;

use Symfony\Component\Security\Core\User\UserInterface;

final class Auth implements UserInterface
{
    public function __construct(private string $username, private string $password)
    {
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt(): string
    {
        return '';
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function eraseCredentials(): void
    {
    }
}
