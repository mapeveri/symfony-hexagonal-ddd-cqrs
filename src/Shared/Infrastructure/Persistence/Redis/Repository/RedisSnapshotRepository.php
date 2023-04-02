<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Redis\Repository;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Snapshot\Snapshot;
use App\Shared\Domain\Snapshot\SnapshotRepository;
use Predis\Client;
use Zumba\JsonSerializer\JsonSerializer;

final class RedisSnapshotRepository implements SnapshotRepository
{
    public function __construct(private Client $redis, private JsonSerializer $serializer)
    {
    }

    public function findById(string $id): ?Snapshot
    {
        $key = sprintf('snapshots:%s', $id);

        /** @var ?string $data */
        $data = $this->redis->get($key);
        if (null === $data) {
            return null;
        }

        $metadata = (array) $this->serializer->unserialize($data);
        $snapshot = (array) $metadata['snapshot'];

        /** @var $aggregate AggregateRoot */
        $aggregate = $this->serializer->unserialize((string) $snapshot['data']);

        return new Snapshot($aggregate, (int) $metadata['version']);
    }

    public function save(string $id, Snapshot $snapshot): void
    {
        $key = sprintf('snapshots:%s', $id);
        $aggregate = $snapshot->aggregate();

        $snapshot = [
            'version' => $snapshot->version(),
            'snapshot' => [
                'type' => get_class($aggregate),
                'data' => $this->serializer->serialize($aggregate)
            ]
        ];

        $this->redis->set($key, $this->serializer->serialize($snapshot));
    }

    public function has(string $id, int $version): bool
    {
        $snapshot = $this->findById($id);

        if (null === $snapshot) {
            return false;
        }

        return $snapshot->version() === $version;
    }
}
