<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Category;

use App\Magazine\Shared\Domain\DomainError;

final class CategoryAssociatedContent extends DomainError
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'category_remove_parent';
    }

    protected function errorMessage(): string
    {
        return sprintf('Cannot remove <%s> because it has associated content.', $this->id);
    }
}
