<?php

declare(strict_types=1);

namespace App\Magazine\Category\Domain;

use App\Shared\Domain\DomainError;

final class CategoryAlreadyExist extends DomainError
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;

        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'category_already_exist';
    }

    protected function errorMessage(): string
    {
        return sprintf('The category <%s> already exist', $this->name);
    }
}
