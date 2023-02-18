<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Create;

use App\Shared\Domain\Bus\Command\Command;

final class CategoryCreateCommand implements Command
{
    public function __construct(
        private string $name,
        private string $description,
        private ?string $parent,
        private bool $hidden
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function hidden(): bool
    {
        return $this->hidden;
    }

    public function parent(): ?string
    {
        return $this->parent;
    }
}
