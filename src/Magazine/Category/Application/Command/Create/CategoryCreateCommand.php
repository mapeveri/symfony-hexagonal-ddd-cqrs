<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Create;

use App\Shared\Domain\Bus\Command\Command;

final class CategoryCreateCommand implements Command
{
    private string $name;
    private string $description;
    private bool $hidden;
    private ?string $parent;

    public function __construct(string $name, string $description, ?string $parent, bool $hidden)
    {
        $this->name = $name;
        $this->description = $description;
        $this->hidden = $hidden;
        $this->parent = $parent;
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
