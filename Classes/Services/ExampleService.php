<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Services;

use JanMaennig\ExampleTests\Domain\Model\ExampleEntity;
use JanMaennig\ExampleTests\Domain\Repository\ExampleEntityRepository;

class ExampleService
{
    private ExampleEntityRepository $exampleEntityRepository;

    public function __construct(ExampleEntityRepository $exampleEntityRepository)
    {
        $this->exampleEntityRepository = $exampleEntityRepository;
    }

    public function isGreaterThanOne(int $value): bool
    {
        return 1 < $value;
    }

    public function createJsonFromExampleEntities(): string
    {
        $entities = $this->exampleEntityRepository->findAll();

        $result = [];

        /** @var ExampleEntity $entity */
        foreach ($entities as $entity) {
            $result[] = [
                'name' => $entity->getTitle(),
            ];
        }

        return (string) json_encode($result);
    }
}
