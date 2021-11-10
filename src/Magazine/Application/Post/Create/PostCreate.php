<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Create;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Post\PostRepository;
use App\Magazine\Domain\User\UserRepository;
use App\Magazine\Shared\Domain\Bus\Event\EventBus;
use App\Magazine\Domain\Category\CategoryRepository;
use App\Magazine\Shared\Domain\Uuid;

final class PostCreate
{
    private PostRepository $repository;
    private CategoryRepository $categoryRepository;
    private UserRepository $userRepository;
    private EventBus $bus;

    public function __construct(
        PostRepository $repository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
        EventBus $bus
    ) {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
        $this->bus = $bus;
    }

    public function __invoke(string $title, string $content, string $categoryId, string $userId, bool $hidden): void
    {
        $category = $this->categoryRepository->find($categoryId);
        $user = $this->userRepository->find($userId);

        $post = Post::create(
            Uuid::next(),
            $title,
            $content,
            $category,
            $user,
            $hidden
        );
        $this->repository->save($post);

        $this->bus->publish(...$post->pullDomainEvents());
    }
}
