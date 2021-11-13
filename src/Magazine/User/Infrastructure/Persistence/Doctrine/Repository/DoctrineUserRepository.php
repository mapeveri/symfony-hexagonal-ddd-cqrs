<?php

declare(strict_types=1);

namespace App\Magazine\User\Infrastructure\Persistence\Doctrine\Repository;

use App\Magazine\User\Domain\User;
use App\Magazine\User\Domain\UserRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    public function find(string $id): ?User
    {
        return $this->repository(User::class)->find($id);
    }

    public function findByUsername(string $username): ?User
    {
        return $this->repository(User::class)->findOneBy(['username' => $username]);
    }

    public function save(User $user): void
    {
        $this->persist($user);
    }
}
