<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Bus\Query;

use App\Magazine\Domain\Bus\Query\Query;
use App\Magazine\Domain\Bus\Query\QueryBus;
use App\Magazine\Domain\Bus\Query\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function handle(Query $query): ?Response
    {
        return $this->handleQuery($query);
    }
}
