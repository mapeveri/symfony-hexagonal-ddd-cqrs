<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Console\Command;

use App\Shared\Infrastructure\Bus\Event\DomainEventSubscriberLocator;
use App\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqDomainEventsConsumer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Lambdish\Phunctional\repeat;

final class ConsumeRabbitMqDomainEventsCommand extends Command
{
    protected static $defaultName = 'app:domain-events:rabbitmq:consume';

    public function __construct(
        private RabbitMqDomainEventsConsumer $consumer,
        private DomainEventSubscriberLocator $locator
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Consume domain events from the RabbitMQ')
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue name')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of events to process')
            ->addArgument('dead_letter', InputArgument::OPTIONAL, 'For consuming the dead letter');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueName       = (string) $input->getArgument('queue');
        $eventsToProcess = (int) $input->getArgument('quantity');
        $deadLetter      = (bool) $input->getArgument('dead_letter');

        repeat($this->consumer($queueName, $deadLetter), $eventsToProcess);

        return 0;
    }

    private function consumer(string $queueName, ?bool $deadLetter): callable
    {
        return function () use ($queueName, $deadLetter) {
            $subscriber = $this->locator->withRabbitMqQueueNamed($queueName);

            if ($deadLetter) {
                $queueName = sprintf('dead_letter.%s', $queueName);
            }

            $this->consumer->consume($subscriber, $queueName);
        };
    }
}