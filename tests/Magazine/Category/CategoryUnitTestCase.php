<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category;

use App\Magazine\Category\Application\Command\Create\CategoryCreator;
use App\Magazine\Category\Application\Command\Create\CategoryCreateCommand;
use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\Services\CategoryFinderByNameChecker;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

class CategoryUnitTestCase extends UnitTestCase
{
    protected CategoryRepository|MockInterface $repository;
    protected CategoryCreator|MockInterface $creator;
    protected CategoryFinder|MockInterface $finder;
    protected CategoryFinderByNameChecker|MockInterface $finderByNameChecker;

    protected function shouldNotFindByName(string $name): void
    {
        $this->finderByNameChecker()
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
            ->with($this->similarTo($category->id()))
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
                return $category->id()->value() === $receivedObject->id()->value() &&
                    $category->name() === $receivedObject->name() &&
                    $category->description() === $receivedObject->description() &&
                    $category->parent()->id() === $receivedObject->parent()->id()  &&
                    $category->hidden() === $receivedObject->hidden();
            }));
    }

    protected function repository(): CategoryRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(CategoryRepository::class);
    }

    protected function creator(): CategoryCreator|MockInterface
    {
        return $this->creator = $this->creator ?? $this->mock(CategoryCreator::class);
    }

    protected function finder(): CategoryFinder|MockInterface
    {
        return $this->finder = $this->finder ?? $this->mock(CategoryFinder::class);
    }

    protected function finderByNameChecker(): CategoryFinderByNameChecker|MockInterface
    {
        return $this->finderByNameChecker = $this->finderByNameChecker ?? $this->mock(CategoryFinderByNameChecker::class);
    }
}