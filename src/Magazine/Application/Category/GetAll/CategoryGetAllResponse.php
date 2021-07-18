<?php

declare(strict_types=1);

namespace App\Magazine\Application\Category\GetAll;

use App\Magazine\Shared\Domain\Bus\Query\Response;

final class CategoryGetAllResponse implements Response
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function data(): array
    {
        return $this->data;
    }
}
