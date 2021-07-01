<?php

declare(strict_types=1);

namespace App\Magazine\Domain\User;

use App\Magazine\Domain\Entity\User;

interface GeneratePassword
{
    public function generate(User $user, string $password): string;
}
