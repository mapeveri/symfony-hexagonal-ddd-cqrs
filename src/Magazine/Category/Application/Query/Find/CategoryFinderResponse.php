<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Query\Find;

use App\Magazine\Category\Domain\Category;
use App\Shared\Domain\Bus\Query\Response;

final class CategoryFinderResponse implements Response
{
    public function __construct(private Category $category)
    {
    }

    public function data(): array
    {
        return [
            'id' => $this->category->id()->value(),
            'name' => $this->category->name(),
            'description' => $this->category->description(),
            'hidden' => $this->category->hidden(),
            'parent' => $this->category->parent()?->id()?->value(),
        ];
    }
}
