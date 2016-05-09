<?php

namespace tests\RoutesTest;

use TestCase;

class RoutesTest extends TestCase
{
    /**
     * A basic functional test example.
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Laravel 5');
    }

    public function testCalendar()
    {
        $this->visit('/calendar')->see('calendar');
    }
}
