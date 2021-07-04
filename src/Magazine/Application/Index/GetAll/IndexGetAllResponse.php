<?php

declare(strict_types=1);

namespace App\Magazine\Application\Index\GetAll;

use App\Magazine\Domain\Bus\Query\Response;

final class IndexGetAllResponse implements Response
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function data(): array
    {
        return $this->data;
    }
}
