<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Update;

use App\Shared\Domain\Bus\Command\Command;

final class CategoryUpdateCommand implements Command
{
    private string $id;
    private string $name;
    private string $description;
    private ?bool $hidden;
    private ?int $parent;

    public function __construct(string $id, string $name, string $description, ?int $parent, ?bool $hidden)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->hidden = $hidden;
        $this->parent = $parent;
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

    public function parent(): ?int
    {
        return $this->parent;
    }
}
