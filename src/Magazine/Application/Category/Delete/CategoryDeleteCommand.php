<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Delete;

use App\Magazine\Shared\Domain\Bus\Command\Command;

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
