<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Persistence\Doctrine\Repository;

use App\Magazine\Domain\Entity\User;
use App\Magazine\Domain\User\UserRepository;
use App\Magazine\Shared\Infrastructure\Persistence\Doctrine\Repository\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    public function find(int $id): ?User
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
