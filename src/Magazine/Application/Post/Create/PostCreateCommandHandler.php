<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Create;

use App\Magazine\Domain\Bus\Command\CommandHandler;
use App\Magazine\Application\Post\Create\PostCreate;
use App\Magazine\Application\Post\Create\PostCreateCommand;

final class PostCreateCommandHandler implements CommandHandler
{
    private $service;

    public function __construct(PostCreate $service)
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
