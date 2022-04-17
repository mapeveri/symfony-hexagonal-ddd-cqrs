<?php

declare(strict_types=1);

namespace App\Magazine\Post\Application\Command\Create;

use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Post\Domain\Post;
use App\Magazine\Post\Domain\PostRepository;
use App\Magazine\User\Domain\UserRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\UuidGenerator;

final class PostCreate
{
    public function __construct(
        private PostRepository $repository,
        private CategoryRepository $categoryRepository,
        private UserRepository $userRepository,
        private EventBus $asyncBus,
        private UuidGenerator $uuidGenerator,
    ) {
    }

    public function __invoke(string $title, string $content, string $categoryId, string $userId, bool $hidden): void
    {
        $category = $this->categoryRepository->find($categoryId);
        $user = $this->userRepository->find($userId);

        $post = Post::create(
            $this->uuidGenerator->generate(),
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
