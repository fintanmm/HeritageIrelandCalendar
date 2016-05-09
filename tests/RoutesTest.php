<?php

namespace tests\RoutesTest;

use TestCase;

class RoutesTest extends TestCase
{
    /**
     * A basic functional test example.
     */
    public function testCalendarIndex()
    {
        $this->visit('/')
             ->see('Feltmaking Workshops');
    }
}
