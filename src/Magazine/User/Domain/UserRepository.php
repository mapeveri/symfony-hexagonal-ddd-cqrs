<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain;

use App\Magazine\User\Domain\ValueObjects\UserId;

interface UserRepository
{
    public function find(UserId $id): ?User;

    public function findByUsername(string $username): ?User;

    public function save(User $category): void;
}
