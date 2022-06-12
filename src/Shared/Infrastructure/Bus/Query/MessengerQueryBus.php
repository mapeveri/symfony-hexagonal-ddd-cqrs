<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

final class MessengerQueryBus implements QueryBus
{
    public function __construct(private MessageBusInterface $queryBus)
    {
    }

    public function handle(Query $query)
    {
        try {
            $response = $this->queryBus->dispatch($query);

            /** @var HandledStamp $handled */
            $handled = $response->last(HandledStamp::class);

            return $handled->getResult();
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                /** @var Throwable $e */
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }
}
