<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Ports;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandBus;

abstract class ApiController
{
    private QueryBus $queryBus;
    private CommandBus $commandBus;
    
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
