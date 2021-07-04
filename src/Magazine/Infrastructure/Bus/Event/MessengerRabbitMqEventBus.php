<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Bus\Event;

use AMQPException;
use App\Magazine\Domain\Event\DomainEvent;
use App\Magazine\Domain\Bus\Event\EventBus;
use App\Magazine\Infrastructure\Bus\Event\RabbitMqConnection;
use App\Magazine\Infrastructure\Bus\Event\DomainEventJsonSerializer;

final class MessengerRabbitMqEventBus implements EventBus
{
    private RabbitMqConnection $connection;
    private string $exchangeName;

    public function __construct(
        RabbitMqConnection $connection,
        string $exchangeName,
    ) {
        $this->connection = $connection;
        $this->exchangeName = $exchangeName;
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach($events as $event) {
            try {
                $this->publishEvent($event);
            } catch (AMQPException $error) {
                // TODO: Failed publish
            }
        }
    }

    private function publishEvent(DomainEvent $event): void
    {
        $body = DomainEventJsonSerializer::serialize($event);
        $routingKey = $event::eventName();
        $messageId  = $event->eventId();

        $this->connection->exchange($this->exchangeName)->publish(
            $body,
            $routingKey,
            AMQP_NOPARAM,
            [
                'message_id'       => $messageId,
                'content_type'     => 'application/json',
                'content_encoding' => 'utf-8',
            ]
        );
    }
}
