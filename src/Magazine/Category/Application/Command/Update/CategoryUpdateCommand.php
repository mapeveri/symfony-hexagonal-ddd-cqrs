<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Update;

use App\Shared\Domain\Bus\Command\Command;

final class CategoryUpdateCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private ?string $parent,
        private ?bool $hidden
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function hidden(): ?bool
    {
        return $this->hidden;
    }

    public function parent(): ?string
    {
        return $this->parent;
    }
}
