<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\Find;

use App\Magazine\Category\Domain\Category;
use App\Shared\Domain\Bus\Query\Response;

final class CategoryFinderResponse implements Response
{
    private Category $category;

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
