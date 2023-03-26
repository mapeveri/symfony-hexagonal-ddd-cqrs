<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Create;

use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Magazine\Category\Domain\Services\CategoryFinderByNameChecker;
use App\Magazine\Category\Domain\ValueObjects\CategoryId;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\UuidGenerator;

class CategoryCreator
{
    public function __construct(
        private CategoryRepository          $repository,
        private CategoryFinder              $serviceFinder,
        private CategoryFinderByNameChecker $serviceFinderByNameChecker,
        private UuidGenerator               $uuidGenerator,
        private EventBus                    $syncBus,
    ) {
    }

    public function __invoke(string $name, string $description, ?string $parent, bool $hidden): void
    {
        $this->ensureCategoryDoesntExists($name);

        $parentCategory = $this->getParentCategory($parent);
        $category = Category::create(
            CategoryId::create($this->uuidGenerator->generate()),
            $name,
            $description,
            $parentCategory,
            $hidden
        );

        $this->repository->save($category);

        $this->syncBus->publish(...$category->pullDomainEvents());
    }

    private function ensureCategoryDoesntExists(string $name): void
    {
        $this->serviceFinderByNameChecker->__invoke($name);
    }

    private function getParentCategory(?string $parent): ?Category
    {
        if (null === $parent) {
            return null;
        }

        return $this->serviceFinder->__invoke(CategoryId::create($parent));
    }
}
