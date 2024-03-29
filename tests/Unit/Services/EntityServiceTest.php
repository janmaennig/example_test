<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Tests\Unit\Services;

use JanMaennig\ExampleTests\Domain\Model\ExampleEntity;
use JanMaennig\ExampleTests\Services\EntityService;
use JanMaennig\ExampleTests\Tests\Mocks\ExampleEntityRepositoryMock;
use PHPUnit\Framework\TestCase;
use Mockery;

class EntityServiceTest extends TestCase
{
    private ExampleEntityRepositoryMock $repositoryMock;

    public function testTotGenerateJsonFromEntities(): void
    {
        $exampleEntity1 = new ExampleEntity();
        $exampleEntity1->setTitle('Müller');

        $exampleEntity2 = new ExampleEntity();
        $exampleEntity2->setTitle('Maier');

        $exampleEntity3 = new ExampleEntity();
        $exampleEntity3->setTitle('Schulze');

        $this->repositoryMock->mockFindAllAnReturnList([
            $exampleEntity1,
            $exampleEntity2,
            $exampleEntity3,
        ]);

        $subject = new EntityService($this->repositoryMock->get());

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

    public function testTotGenerateJsonFromWithoutEntities(): void
    {
        $this->repositoryMock->mockFindAllAndReturnsEmpty();

        $subject = new EntityService($this->repositoryMock->get());

        $this->assertJsonStringEqualsJsonString(
            <<< 'JSON'
                []
            JSON,
            $subject->createJsonFromExampleEntities()
        );
    }

    protected function setUp(): void
    {
        $this->repositoryMock = new ExampleEntityRepositoryMock();
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}
