<?php

declare(strict_types=1);

namespace App\Magazine\Domain\Bus\Query;

use App\Magazine\Domain\Bus\Query\Response;

interface QueryBus
{
    public function handle(Query $query): ?Response;
}
