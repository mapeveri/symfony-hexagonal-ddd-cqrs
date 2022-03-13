<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Category\Application\Command\Create;

use App\Magazine\Category\Application\Command\Create\CategoryCreateCommandHandler;
use App\Tests\Magazine\Category\CategoryUnitTestCase;
use App\Tests\Magazine\Shared\Utils\Faker\Faker;

final class CategoryCreateCommandHandlerTest extends CategoryUnitTestCase
{
    private CategoryCreateCommandHandler $SUT;

    public function setUp(): void
    {
        $this->SUT = new CategoryCreateCommandHandler($this->creator());

        parent::setUp();
    }

    public function testCreateCategory()
    {
        $command = CategoryCreateCommandMother::create(
            Faker::random()->name(),
            Faker::random()->text(),
            Faker::random()->uuid(),
            false,
        );

        $this->shouldCreate($command);

        $this->dispatch($command, $this->SUT);
    }
}