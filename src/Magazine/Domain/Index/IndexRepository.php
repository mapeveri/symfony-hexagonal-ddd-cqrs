<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Index;

interface IndexRepository
{
    public function getAll(): array;

    public function add(string $id, array $data): void;
}
