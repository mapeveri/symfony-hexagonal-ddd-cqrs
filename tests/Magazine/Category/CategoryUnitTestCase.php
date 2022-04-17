<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category;

use App\Magazine\Category\Application\Command\Create\CategoryCreate;
use App\Magazine\Category\Application\Command\Create\CategoryCreateCommand;
use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\CategoryFinderName;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Tests\Magazine\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

class CategoryUnitTestCase extends UnitTestCase
{
    protected CategoryRepository|MockInterface $repository;
    protected CategoryCreate|MockInterface $creator;
    protected CategoryFinder|MockInterface $finder;
    protected CategoryFinderName|MockInterface $finderName;

    protected function shouldNotFindByName(string $name): void
    {
        $this->finderName()
            ->shouldReceive('__invoke')
            ->once()
            ->with($name)
            ->andReturnNull();
    }

    protected function shouldFind(Category $category): void
    {
        $this->finder()
            ->shouldReceive('__invoke')
            ->once()
            ->with($category->id())
            ->andReturn($category);
    }

    protected function shouldCreate(CategoryCreateCommand $command): void
    {
        $this->creator()
            ->shouldReceive('__invoke')
            ->once()
            ->with(
                $command->name(),
                $command->description(),
                $command->parent(),
                $command->hidden(),
            );
    }

    protected function shouldSave(Category $category): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with(\Mockery::on(function ($receivedObject) use ($category): bool {
                return $category->id() === $receivedObject->id() &&
                    $category->name() === $receivedObject->name() &&
                    $category->description() === $receivedObject->description() &&
                    $category->parent() === $receivedObject->parent()  &&
                    $category->hidden() === $receivedObject->hidden();
            }));
    }

    protected function repository(): CategoryRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(CategoryRepository::class);
    }

    protected function creator(): CategoryCreate|MockInterface
    {
        return $this->creator = $this->creator ?? $this->mock(CategoryCreate::class);
    }

    protected function finder(): CategoryFinder|MockInterface
    {
        return $this->finder = $this->finder ?? $this->mock(CategoryFinder::class);
    }

    protected function finderName(): CategoryFinderName|MockInterface
    {
        return $this->finderName = $this->finderName ?? $this->mock(CategoryFinderName::class);
    }
}