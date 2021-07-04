<?php

declare(strict_types=1);

namespace App\Magazine\Infrastructure\Symfony\EventListener;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Bus\Command\CommandBus;
use App\Magazine\Infrastructure\Projection\Elasticsearch\PostProjection;
use App\Magazine\Application\Notification\NewPostEmailAdmin\NewPostEmailAdminCommand;

final class PostEvent
{
    private CommandBus $commandBus;
    private PostProjection $projection;

    public function __construct(CommandBus $commandBus, PostProjection $projection)
    {
        $this->commandBus = $commandBus;
        $this->projection = $projection;
    }

    public function postPersist(Post $post): void
    {
        $this->commandBus->dispatch(new NewPostEmailAdminCommand($post->title(), $post->content()));
        $this->projection->project($post);
    }
}
