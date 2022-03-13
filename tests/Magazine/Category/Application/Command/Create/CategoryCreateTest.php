<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Application\Command\Create;

use App\Magazine\Category\Application\Command\Create\CategoryCreate;
use App\Tests\Magazine\Category\CategoryUnitTestCase;
use App\Tests\Magazine\Category\Domain\CategoryMother;
use App\Tests\Magazine\Shared\Utils\Faker\Faker;
use function Lambdish\Phunctional\apply;

final class CategoryCreateTest extends CategoryUnitTestCase
{
    private CategoryCreate $SUT;

    public function setUp(): void
    {
        $this->SUT = new CategoryCreate(
            $this->repository(),
            $this->finder(),
            $this->finderName(),
            $this->uuidGenerator()
        );

        parent::setUp();
    }

    public function testCreateCategory()
    {
        $name = Faker::random()->name();
        $parentId = Faker::random()->uuid();

        $parentCategory = CategoryMother::create(['id' => $parentId]);
        $category = CategoryMother::create([
            'name' => $name,
            'description' => Faker::random()->text(),
            'parent' => $parentCategory,
            'hidden' => false
        ]);

        $this->shouldNotFindByName($name);
        $this->shouldFind($parentCategory);
        $this->shouldGenerateUuid($category->id());
        $this->shouldSave($category);

        apply($this->SUT, [
            $category->name(),
            $category->description(),
            $category->parent()->id(),
            $category->hidden()
        ]);
    }
}