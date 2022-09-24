<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Query\GetAll;

use App\Shared\Domain\Bus\Query\Query;

final class IndexGetAllQuery implements Query
{
    public function __construct(private ?string $search, private ?array $ids)
    {
    }

    public function search(): ?string
    {
        return $this->search;
    }

    public function ids(): ?array
    {
        return $this->ids;
    }
}
