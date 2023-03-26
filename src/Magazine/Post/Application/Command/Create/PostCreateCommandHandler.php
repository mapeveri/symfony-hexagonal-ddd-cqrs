<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Command\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class PostCreateCommandHandler implements CommandHandler
{
    private PostCreator $service;

    public function __construct(PostCreator $service)
    {
        $this->service = $service;
    }

    public function __invoke(PostCreateCommand $command): void
    {
        $this->service->__invoke(
            $command->title(),
            $command->content(),
            $command->category(),
            $command->user(),
            $command->hidden()
        );
    }
}
