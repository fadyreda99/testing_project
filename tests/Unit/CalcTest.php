<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CalcTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_calc(): void
    {
        $calc = calc(20, 20);
        $this->assertEquals(40, $calc);
    }
}
