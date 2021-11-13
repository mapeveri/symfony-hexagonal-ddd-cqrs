<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

final class Category
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var self
     */
    private $parent;

    /**
     * @var boolean
     */
    private $hidden;

    /**
     * @var array
     */
    private $children;

    /**
     * @var array
     */
    private $posts;

    /**
     * @var array
     */
    private $categories;

    public function __construct(string $id, string $name, string $description, ?self $parent, bool $hidden)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->parent = $parent;
        $this->hidden = $hidden;
        $this->children = [];
        $this->posts = [];
        $this->categories = [];
    }

    public static function create(string $id, string $name, string $description, ?self $parent, bool $hidden): self
    {
        return new self($id, $name, $description, $parent, $hidden);
    }

    public function id(): string
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
