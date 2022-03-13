<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Application\Command\Create;

use App\Magazine\Category\Application\Command\Create\CategoryCreateCommand;

class CategoryCreateCommandMother
{
    public static function create(string $name, string $description, string $parent, bool $hidden): CategoryCreateCommand
    {
        return new CategoryCreateCommand($name, $description, $parent, $hidden);
    }
}