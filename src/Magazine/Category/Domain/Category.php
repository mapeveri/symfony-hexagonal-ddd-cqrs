<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

use App\Magazine\Category\Domain\Event\CategoryWasCreatedEvent;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Aggregate\AggregateRoot;

class Category extends AggregateRoot
{
    private $children;
    private $posts;
    private $categories;

    public function __construct(
        private CategoryId $id,
        private string $name,
        private string $description,
        private ?self $parent,
        private bool $hidden
    ) {
        $this->children = [];
        $this->posts = [];
        $this->categories = [];
    }

    public static function create(CategoryId $id, string $name, string $description, ?self $parent, bool $hidden): self
    {
        $category = new self($id, $name, $description, $parent, $hidden);
        $category->record(new CategoryWasCreatedEvent($category->id()->value(), $category->name()));
        return $category;
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function rename(string $name): void
    {
        $this->name = $name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function parent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): void
    {
        $this->parent = $parent;
    }

    public function hidden(): ?bool
    {
        return $this->hidden;
    }

    public function setHidden(?bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function children(): array
    {
        return $this->children;
    }

    public function posts(): array
    {
        return $this->posts;
    }

    public function categories(): array
    {
        return $this->categories;
    }
}
