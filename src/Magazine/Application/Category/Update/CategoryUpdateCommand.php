<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Update;

use App\Magazine\Domain\Bus\Command\Command;

final class CategoryUpdateCommand implements Command
{
    private int $id;
    private string $name;
    private string $description;
    private ?int $hidden;
    private bool $parent;

    public function __construct(int $id, string $name, string $description, ?int $parent, bool $hidden)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->hidden = $hidden;
        $this->parent = $parent;
    }

    public function id(): int
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

    public function hidden(): bool
    {
        return $this->hidden;
    }

    public function parent(): ?int
    {
        return $this->parent;
    }
}
