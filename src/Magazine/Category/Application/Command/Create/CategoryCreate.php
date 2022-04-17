<?php

declare(strict_types=1);

namespace App\Magazine\Category\Application\Command\Create;

use App\Magazine\Category\Application\Query\Find\CategoryFinder;
use App\Magazine\Category\Domain\Category;
use App\Magazine\Category\Domain\CategoryFinderName;
use App\Magazine\Category\Domain\CategoryRepository;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\UuidGenerator;

class CategoryCreate
{
    public function __construct(
        private CategoryRepository $repository,
        private CategoryFinder $serviceFinder,
        private CategoryFinderName $serviceFinderName,
        private UuidGenerator $uuidGenerator,
        private EventBus $syncBus,
    ) {
    }

    public function __invoke(string $name, string $description, ?string $parent, bool $hidden): void
    {
        // Throw exception if the category exists
        $this->serviceFinderName->__invoke($name);

        $parentCategory = ($parent ? $this->serviceFinder->__invoke($parent) : null);
        $category = Category::create(
            $this->uuidGenerator->generate(),
            $name,
            $description,
            $parentCategory,
            $hidden
        );

        $this->repository->save($category);

        $this->syncBus->publish(...$category->pullDomainEvents());
    }
}
