<?php

declare(strict_types=1);

namespace App\Magazine\Portal\Application\Command\Create;

use App\Magazine\Portal\Domain\PortalPost;
use App\Magazine\Portal\Domain\PortalRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreatePortalPostCommandHandler implements CommandHandler
{
    public function __construct(private readonly PortalRepository $repository)
    {
    }

    public function __invoke(CreatePortalPostCommand $command): void
    {
        $data = $command->data();
        $portalPost = PortalPost::create($command->id(), $data['title'], $data['content']);

        $this->repository->save($portalPost);
    }
}