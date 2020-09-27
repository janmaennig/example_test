<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Tests\Mocks;

use JanMaennig\ExampleTests\Domain\Repository\ExampleEntityRepository;
use Mockery;

class ExampleEntityRepositoryMock
{
    private $mock;

    public function __construct()
    {
        $this->mock = Mockery::mock(ExampleEntityRepository::class);
    }

    public function get(): ExampleEntityRepository
    {
        return $this->mock;
    }

    public function mockFindAllAnReturnList(array $listEntries): void
    {
        $this->mock
            ->shouldReceive('findAll')
            ->andReturn($listEntries);
    }

    public function mockFindAllAndReturnsEmpty(): void
    {
        $this->mock
            ->shouldReceive('findAll')
            ->andReturn([]);
    }
}
