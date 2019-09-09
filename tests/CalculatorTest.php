<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Services\Calculator;

class CalculatorTest extends TestCase
{
    public function testSomething()
    {
        $calc = new Calculator();
        $result = $calc->add(2, 3);
        $this->assertEquals(5, $result);
    }
}
