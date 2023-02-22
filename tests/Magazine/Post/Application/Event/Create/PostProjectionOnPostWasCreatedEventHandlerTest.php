<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Post\Application\Event\Create;

use App\Magazine\Post\Application\Event\Create\PostProjectionOnPostWasCreatedEventHandler;
use App\Tests\Magazine\Portal\Application\Command\Create\CreatePortalPostCommandMother;
use App\Tests\Magazine\Post\Domain\Events\PostWasCreatedEventMother;
use App\Tests\Magazine\Post\PostUnitTestCase;
use function Lambdish\Phunctional\apply;

final class PostProjectionOnPostWasCreatedEventHandlerTest extends PostUnitTestCase
{
    private PostProjectionOnPostWasCreatedEventHandler $SUT;

    public function setUp(): void
    {
        $this->SUT = new PostProjectionOnPostWasCreatedEventHandler($this->commandBus());

        parent::setUp();
    }

    public function testCreateProjectionPost()
    {
        $event = PostWasCreatedEventMother::create();

        $command = CreatePortalPostCommandMother::create([
            'id' => $event->aggregateId(),
            'data' => ['title' => $event->title(), 'content' => $event->content()]
        ]);

        $this->shouldDispatchCommand($command);

        apply($this->SUT, [$event]);
    }
}