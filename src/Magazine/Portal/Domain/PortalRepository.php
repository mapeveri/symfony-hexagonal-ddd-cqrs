<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Domain;

interface PortalRepository
{
    public function getAll(): array;

    public function add(string $id, array $data): void;
}
