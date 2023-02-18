<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Application\Command\Create;

use App\Magazine\Category\Application\Command\Create\CategoryCreate;
use App\Tests\Magazine\Category\CategoryUnitTestCase;
use App\Tests\Magazine\Category\Domain\CategoryMother;
use App\Tests\Magazine\Category\Domain\Events\CategoryWasCreatedEventMother;
use App\Tests\Magazine\Category\Domain\ValueObjects\CategoryIdMother;
use App\Tests\Shared\Utils\Faker\Faker;
use function Lambdish\Phunctional\apply;

final class CategoryCreateTest extends CategoryUnitTestCase
{
    private CategoryCreate $SUT;

    public function setUp(): void
    {
        $this->SUT = new CategoryCreate(
            $this->repository(),
            $this->finder(),
            $this->finderByNameChecker(),
            $this->uuidGenerator(),
            $this->eventBus(),
        );

        parent::setUp();
    }

    public function testCreateCategory()
    {
        $name = Faker::random()->name();
        $parentId = Faker::random()->uuid();

        $parentCategory = CategoryMother::create(['id' => CategoryIdMother::create($parentId)]);
        $category = CategoryMother::create([
            'name' => $name,
            'description' => Faker::random()->text(),
            'parent' => $parentCategory,
            'hidden' => false
        ]);

        $this->shouldNotFindByName($name);
        $this->shouldFind($parentCategory);
        $this->shouldGenerateUuid($category->id()->value());
        $this->shouldSave($category);
        $this->shouldPublishDomainEvent(CategoryWasCreatedEventMother::create(['id' => $category->id()->value(), 'name' => $category->name()]));

        apply($this->SUT, [
            $category->name(),
            $category->description(),
            $parentId,
            $category->hidden()
        ]);
    }
}