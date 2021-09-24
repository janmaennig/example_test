<?php

declare(strict_types=1);

namespace JanMaennig\ExampleTests\Tests\Unit\Services;

use JanMaennig\ExampleTests\Services\ComparisonService;
use PHPUnit\Framework\TestCase;

class ComparisonServiceTest extends TestCase
{
    public function testIfValueGreaterThanOne(): void
    {
        $subject = new ComparisonService();

        $this->assertTrue($subject->isGreaterThanOne(2));
    }

    public function testIfValueSmallerThanOne(): void
    {
        $subject = new ComparisonService();

        $this->assertFalse($subject->isGreaterThanOne(0));
    }

    public function testIfValueIsOne(): void
    {
        $subject = new ComparisonService();

        $this->assertFalse($subject->isGreaterThanOne(1));
    }
}
