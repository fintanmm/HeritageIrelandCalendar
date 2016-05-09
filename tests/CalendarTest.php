<?php

namespace tests;

use TestCase;

class CalendarTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testIndex()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
    }
}
