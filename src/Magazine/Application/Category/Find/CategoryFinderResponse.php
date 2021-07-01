<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\Find;

use App\Magazine\Domain\Entity\Category;
use App\Magazine\Domain\Bus\Query\Response;

final class CategoryFinderResponse implements Response
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function data(): array
    {
        $parent = $this->category->parent();
        return [
            'id' => $this->category->id(),
            'name' => $this->category->name(),
            'description' => $this->category->description(),
            'hidden' => $this->category->hidden(),
            'parent' => ($parent ? $parent->id() : null),
        ];
    }
}
