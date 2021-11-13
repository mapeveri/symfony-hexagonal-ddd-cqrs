<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain;

interface GeneratePassword
{
    public function generate(User $user, string $password): string;
}
