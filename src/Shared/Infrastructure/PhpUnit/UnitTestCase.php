<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\PhpUnit;

use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Event\Event;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Domain\UuidGenerator;
use Exception;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    private EventBus|MockInterface|null $eventBus;
    private QueryBus|MockInterface $queryBus;
    private UuidGenerator|MockInterface $uuidGenerator;

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function shouldPublishDomainEvent(Event $domainEvent): void
    {
        $this->eventBus()
            ->shouldReceive('dispatch')
            ->with($this->equalTo($domainEvent))
            ->andReturnNull();
    }

    protected function shouldDispatchQuery(Query $query, mixed $result = null): void
    {
        $this->queryBus()
            ->shouldReceive('dispatch')
            ->with($this->equalTo($query))
            ->andReturn($result);
    }

    protected function shouldNotPublishDomainEvent(): void
    {
        $this->eventBus()
            ->shouldReceive('dispatch')
            ->withNoArgs()
            ->andReturnNull();
    }

    protected function shouldGenerateUuid(string $uuid): void
    {
        $this->uuidGenerator()
            ->shouldReceive('generate')
            ->once()
            ->withNoArgs()
            ->andReturn($uuid);
    }

    protected function eventBus(): EventBus|MockInterface
    {
        return $this->eventBus = $this->eventBus ?? $this->mock(EventBus::class);
    }

    protected function uuidGenerator(): UuidGenerator|MockInterface
    {
        return $this->uuidGenerator = $this->uuidGenerator ?? $this->mock(UuidGenerator::class);
    }

    protected function queryBus(): QueryBus|MockInterface
    {
        return $this->queryBus = $this->queryBus ?? $this->mock(QueryBus::class);
    }

    protected function dispatch(Command $command, callable $commandHandler): void
    {
        $this->instanceOf($commandHandler, CommandHandler::class);
        $commandHandler($command);
    }

    protected function assertAskResponse(Response $expected, Query $query, callable $queryHandler): void
    {
        $this->instanceOf($queryHandler, QueryHandler::class);
        $actual = $queryHandler($query);

        $this->assertEquals($expected, $actual);
    }

    protected function assertAsk(mixed $expected, Query $query, callable $queryHandler): void
    {
        $this->instanceOf($queryHandler, QueryHandler::class);
        $actual = $queryHandler($query);

        $this->assertEquals($expected, $actual);
    }

    protected function assertAskThrowsException(string $expectedErrorClass, Query $query, callable $queryHandler): void
    {
        $this->expectException($expectedErrorClass);

        $this->instanceOf($queryHandler, QueryHandler::class);
        $queryHandler($query);
    }

    protected function instanceOf(mixed $object, string $instance): void
    {
        if (!$object instanceof $instance) {
            throw new Exception(sprintf('Not instance of %s', $instance));
        }
    }
}