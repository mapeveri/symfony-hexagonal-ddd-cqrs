<?php

declare(strict_types=1);

namespace App\Magazine\User\Domain;

interface UserRepository
{
    public function find(string $id): ?User;

    public function findByUsername(string $username): ?User;

    public function save(User $category): void;
}
