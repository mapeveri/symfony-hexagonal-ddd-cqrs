<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Delete;

use App\Shared\Domain\Bus\Command\Command;

final class CategoryDeleteCommand implements Command
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
