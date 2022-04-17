<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Command\Create;

use App\Magazine\Portal\Domain\PortalRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreatePortalPostCommandHandler implements CommandHandler
{
    public function __construct(private PortalRepository $repository)
    {
    }

    public function __invoke(CreatePortalPostCommand $command): void
    {
        $this->repository->add(
            $command->id(),
            $command->data()
        );
    }
}