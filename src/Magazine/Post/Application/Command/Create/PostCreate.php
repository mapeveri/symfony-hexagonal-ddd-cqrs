<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Command\Create;

use App\Magazine\Category\Application\Query\Find\CategoryFinderQuery;
use App\Magazine\Post\Domain\Post;
use App\Magazine\Post\Domain\PostRepository;
use App\Magazine\Post\Domain\ValueObjects\PostId;
use App\Magazine\User\Application\Query\Find\UserFinderQuery;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\UuidGenerator;

final class PostCreate
{
    public function __construct(
        private QueryBus $queryBus,
        private PostRepository $repository,
        private EventBus $asyncBus,
        private UuidGenerator $uuidGenerator,
    ) {
    }

    public function __invoke(string $title, string $content, string $categoryId, string $userId, bool $hidden): void
    {
        $category = $this->queryBus->handle(new CategoryFinderQuery($categoryId));
        $user = $this->queryBus->handle(new UserFinderQuery($userId));

        $post = Post::create(
            PostId::create($this->uuidGenerator->generate()),
            $title,
            $content,
            $category,
            $user,
            $hidden
        );
        $this->repository->save($post);

        $this->asyncBus->publish(...$post->pullDomainEvents());
    }
}
