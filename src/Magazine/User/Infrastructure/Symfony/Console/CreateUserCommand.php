<?php

namespace App\Magazine\User\Infrastructure\Symfony\Console;

use App\Magazine\User\Application\Command\Create\UserCreateCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateUserCommand extends Command
{
    public function __construct(private CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('app:create-user')
            ->setDescription('Create a new user');
        
        $this->addArgument('username', InputArgument::REQUIRED, 'Username');
        $this->addArgument('email', InputArgument::REQUIRED, 'Email');
        $this->addArgument('password', InputArgument::REQUIRED, 'Password');
        $this->addArgument('isActive', InputArgument::REQUIRED, 'If is an active user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $isActive = $input->getArgument('isActive');

        $this->commandBus->dispatch(new UserCreateCommand(
            $username,
            $email,
            $password,
            $isActive
        ));

        $output->writeln("<info>User: {$email} created.</info>");

        return Command::SUCCESS;
    }
}
