<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Domain\Aggregate\AggregateHistory;
use App\Shared\Domain\EventStore\EventStoreRepository;
use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\ValueObjects\Uuid;
use Doctrine\DBAL\Connection;
use DateTimeImmutable;

final class DBALEventStoreRepository implements EventStoreRepository
{
    public function __construct(private Connection $connection)
    {
    }

    public function commit(EventStream $eventStream): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO event_store (id, aggregate_id, `type`, created_at, `data`)
             VALUES (:id, :aggregate_id, :type, :created_at, :data)'
        );

        foreach ($eventStream as $event) {
            $stmt->executeQuery([
                ':id' => Uuid::random()->value(),
                ':aggregate_id' => (string) $event->aggregateId(),
                ':type'         => get_class($event),
                ':created_at'   => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
                ':data'         => json_encode($event->toPrimitives()),
            ]);
        }
    }

    public function getAggregateHistoryFor(Uuid $id): AggregateHistory
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM event_store WHERE aggregate_id = :aggregate_id'
        );
        $resultSet = $stmt->executeQuery([':aggregate_id' => (string) $id]);

        $events = [];
        $resultData = $resultSet->fetchAllAssociative();
        foreach ($resultData as $row) {
            $event = $row['type']::fromPrimitives(
                $id->value(),
                json_decode($row['data'], true),
                $row['id'],
                $row['created_at'],
            );

            $events[] = $event;
        }

        return new AggregateHistory($id, $events);
    }
}
