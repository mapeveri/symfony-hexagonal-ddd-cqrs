<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Portal;

use App\Magazine\Portal\Domain\PortalRepository;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

class PortalUnitTestCase extends UnitTestCase
{
    protected PortalRepository|MockInterface $repository;

    protected function shouldSearch($withEmptyData = false): array
    {
        $data = $this->getDataAll();
        $returnData = $withEmptyData ? [] : $data;

        $this->repository()
            ->shouldReceive('search')
            ->once()
            ->andReturn($returnData);

        return $returnData;
    }

    protected function repository(): PortalRepository|MockInterface
    {
        return $this->repository = $this->repository ?? $this->mock(PortalRepository::class);
    }

    private function getDataAll(): array
    {
        return [
            'data' => [
                'id' => 'ee9eca97-04b2-48df-9952-6a92f41194e6',
                'title' => 'Post 1',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            ]
        ];
    }
}