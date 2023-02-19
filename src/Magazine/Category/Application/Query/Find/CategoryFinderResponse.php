<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\Find;

use App\Shared\Domain\Bus\Query\Response;

final class CategoryFinderResponse implements Response
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private ?string $parent,
        private bool $hidden
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

    public function parent(): ?string
    {
        return $this->parent;
    }

    public function hidden(): ?bool
    {
        return $this->hidden;
    }

    public function data(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'description' => $this->description(),
            'hidden' => $this->hidden(),
            'parent' => $this->parent(),
        ];
    }
}
