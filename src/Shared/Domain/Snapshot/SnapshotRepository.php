<?php

declare(strict_types=1);

namespace App\Shared\Domain\Snapshot;

interface SnapshotRepository
{
    public function findById(string $id): ?Snapshot;
    public function save(string $id, Snapshot $snapshot): void;
    public function has(string $id, int $version): bool;
}
