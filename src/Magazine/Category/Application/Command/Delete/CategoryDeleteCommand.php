<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Delete;

use App\Shared\Domain\Bus\Command\Command;

final class CategoryDeleteCommand implements Command
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
