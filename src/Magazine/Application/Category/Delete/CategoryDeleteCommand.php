<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Delete;

use App\Magazine\Shared\Domain\Bus\Command\Command;

final class CategoryDeleteCommand implements Command
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}
