<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Portal\Application\Query\GetAll;

use App\Magazine\Portal\Application\Query\GetAll\IndexGetAll;
use App\Magazine\Portal\Application\Query\GetAll\IndexGetAllQuery;
use App\Magazine\Portal\Application\Query\GetAll\IndexGetAllQueryHandler;
use App\Magazine\Portal\Application\Query\GetAll\IndexGetAllResponse;
use App\Tests\Magazine\Portal\PortalUnitTestCase;
use function Lambdish\Phunctional\apply;

final class IndexGetAllQueryHandlerTest extends PortalUnitTestCase
{
    private IndexGetAllQueryHandler $SUT;

    public function setUp(): void
    {
        $this->SUT = new IndexGetAllQueryHandler(new IndexGetAll($this->repository()));

        parent::setUp();
    }

    public function testGetAllEmptyData()
    {
        $query = new IndexGetAllQuery();

        $dataExpected = $this->shouldGetAll(true);

        $response = apply($this->SUT, [$query]);

        $this->assertEquals($this->getResponse($dataExpected), $response);
    }

    public function testGetAllData()
    {
        $query = new IndexGetAllQuery();

        $dataRepository = $this->shouldGetAll();
        $dataExpected = $this->processData($dataRepository);

        $response = apply($this->SUT, [$query]);

        $this->assertEquals($this->getResponse($dataExpected), $response);
    }

    private function processData(array $dataRepository): array
    {
        $dataIndex = $dataRepository['data']['hits']['hits'];
        $index = $dataIndex[0];
        $record = $index['_source'];

        $dataExpected[] = [
            'id' => $record['id'],
            'title' => $record['title'],
            'content' => $record['content'],
        ];

        return $dataExpected;
    }

    private function getResponse(array $dataExpected): IndexGetAllResponse
    {
        return new IndexGetAllResponse($dataExpected);
    }
}