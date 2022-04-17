<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Post;

use App\Magazine\Post\Domain\PostRepository;
use App\Tests\Magazine\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

class PostUnitTestCase extends UnitTestCase
{
    protected PostRepository|MockInterface $repository;

    protected function repository(): PostRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(PostRepository::class);
    }
}