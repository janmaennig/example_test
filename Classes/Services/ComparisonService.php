<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Services;

class ComparisonService
{
    public function isGreaterThanOne(int $value): bool
    {
        return 1 < $value;
    }
}
