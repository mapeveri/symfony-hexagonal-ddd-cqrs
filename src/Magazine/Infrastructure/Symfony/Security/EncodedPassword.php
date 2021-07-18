<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Symfony\Security;

use App\Magazine\Domain\Entity\User;
use App\Magazine\Domain\User\GeneratePassword;
use App\Magazine\Infrastructure\Symfony\Security\Auth;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class EncodedPassword implements GeneratePassword
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->encoder = $passwordHasher;
    }

    public function generate(User $user, string $password): string
    {
        $authUser = new Auth($user->getUsername(), $password);
        return $this->encoder->hashPassword($authUser, $password);
    }
}
