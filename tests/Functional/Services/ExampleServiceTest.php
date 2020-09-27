<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Tests\Functional\Services;

use Nimut\TestingFramework\TestCase\FunctionalTestCase;
use JanMaennig\ExampleTests\Domain\Repository\ExampleEntityRepository;
use JanMaennig\ExampleTests\Services\ExampleService;

class ExampleServiceTest extends FunctionalTestCase
{
    protected ExampleEntityRepository $repository;

    protected $testExtensionsToLoad = [
        'typo3conf/ext/example_test',
    ];

    public function testCreateJsonWithDatabaseConnection(): void
    {
        $subject = new ExampleService($this->repository);

        $this->assertJsonStringEqualsJsonString(
            <<< 'JSON'
                [
                    {
                        "name": "Müller"
                    },
                    {
                        "name": "Maier"
                    },
                    {
                        "name": "Schulze"
                    }
                ]
            JSON,
            $subject->createJsonFromExampleEntities()
        );
    }

    protected function setUp(): void
    {
        define('ORIGINAL_ROOT', __DIR__ . '/../../../public/');

        parent::setUp();

        $this->importDataSet(__DIR__ . '/../../Fixtures/Records.xml');

        $this->repository = new ExampleEntityRepository();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
