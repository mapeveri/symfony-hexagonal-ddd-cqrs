<?php

declare(strict_types=1);

namespace App\Magazine\Application\Post\Create;

use App\Magazine\Domain\Entity\Post;
use App\Magazine\Domain\Post\PostRepository;
use App\Magazine\Domain\User\UserRepository;
use App\Magazine\Domain\Category\CategoryRepository;

final class PostCreate
{
    private $repository;
    private $categoryRepository;
    private $userRepository;

    public function __construct(
        PostRepository $repository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository
    ) {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    public function __invoke(string $title, string $content, int $categoryId, int $userId, bool $hidden): void
    {
        $category = $this->categoryRepository->find($categoryId);
        $user = $this->userRepository->find($userId);

        $post = Post::create($title, $content, $category, $user, $hidden);
        $this->repository->save($post);
    }
}
