<?php

namespace Tests\Unit;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class PeriodBreakdownUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDiffInSeconds()
    {
        $start = Carbon::parse('2021-01-01T00:00:00');
        $end = Carbon::parse('2021-03-01T12:30:00');
        $this->assertEquals(5142600, $start->diffInSeconds($end));
    }
}
