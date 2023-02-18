<?php

declare(strict_types=1);

namespace App\Magazine\User\Infrastructure\Symfony\Security;

use App\Magazine\User\Domain\GeneratePassword;
use App\Magazine\User\Domain\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class EncodedPassword implements GeneratePassword
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function generate(User $user, string $password): string
    {
        $authUser = new Auth($user->getUsername(), $password);
        return $this->passwordHasher->hashPassword($authUser, $password);
    }
}
