<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Repository;

use App\Shared\Domain\Aggregate\AggregateHistory;
use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\DatetimeUtils;
use App\Shared\Domain\EventStore\EventStoreRepository;
use App\Shared\Domain\EventStream\EventStream;
use App\Shared\Domain\ValueObjects\Uuid;
use Doctrine\DBAL\Connection;
use DateTimeImmutable;
use Zumba\JsonSerializer\JsonSerializer;

final class DBALEventStoreRepository implements EventStoreRepository
{
    public function __construct(private Connection $connection, private JsonSerializer $serializer)
    {
    }

    public function commit(EventStream $eventStream, int $version): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO event_store (id, aggregate_id, version, `type`, created_at, `data`)
             VALUES (:id, :aggregate_id, :version, :type, :created_at, :data)'
        );

        foreach ($eventStream as $event) {
            $stmt->executeQuery([
                ':id' => Uuid::random()->value(),
                ':aggregate_id' => (string) $event->aggregateId(),
                ':version'      => $version,
                ':type'         => get_class($event),
                ':created_at'   => (new DateTimeImmutable())->format(DatetimeUtils::DATETIME_FORMAT),
                ':data'         => $this->serializer->serialize($event->toPrimitives()),
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
                $this->serializer->unserialize($row['data']),
                $row['id'],
                $row['created_at'],
            );

            $events[] = $event;
        }

        return new AggregateHistory($id, new EventStream($events));
    }

    public function fromVersion(string $id, int $version): EventStream
    {
        $stmt = $this->connection->prepare(
            'SELECT * FROM event_store WHERE aggregate_id = :aggregate_id AND version = :version'
        );
        $resultSet = $stmt->executeQuery([':aggregate_id' => $id, ':version' => $version]);

        /** @var DomainEvent[] $events */
        $events = [];
        $resultData = $resultSet->fetchAllAssociative();
        foreach ($resultData as $row) {
            $event = $row['type']::fromPrimitives(
                $id,
                $this->serializer->unserialize($row['data']),
                $row['id'],
                $row['created_at'],
            );

            $events[] = $event;
        }

        return new EventStream($events);
    }

    public function countEventsFor(Uuid $id): int
    {
        $stmt = $this->connection->prepare(
            'SELECT COUNT(*) as total FROM event_store WHERE aggregate_id = :aggregate_id'
        );
        $resultSet = $stmt->executeQuery([':aggregate_id' => (string) $id]);
        $resultData = $resultSet->fetchAllAssociative();
        return (int)$resultData[0]['total'];
    }
}
