<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Symfony;

use App\Magazine\Domain\Bus\Query\Query;
use App\Magazine\Domain\Bus\Query\QueryBus;
use App\Magazine\Domain\Bus\Query\Response;
use App\Magazine\Domain\Bus\Command\Command;
use App\Magazine\Domain\Bus\Command\CommandBus;

abstract class ApiController
{
    private $queryBus;
    private $commandBus;
    
    public function __construct(QueryBus $queryBus, CommandBus $commandBus)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
    }

    protected function handle(Query $query): ?Response
    {
        return $this->queryBus->handle($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
