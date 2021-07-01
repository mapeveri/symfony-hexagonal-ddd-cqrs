<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Category;

use App\Magazine\Domain\DomainError;

final class CategoryNotExist extends DomainError
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'category_not_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The category <%s> does not exist', $this->id);
    }
}
