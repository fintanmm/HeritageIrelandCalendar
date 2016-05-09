<?php

namespace tests;

use TestCase;
use HeritageCalendar\Events;

class EventsTest extends TestCase
{
    public function testGet()
    {
        $events = new Events();
        $getEvents = $events->get();
        $testEventData = [
          'id' => 'd.en.36304',
          'title' => 'Feltmaking Workshops',
          'startdate' => '01/05/16',
          'enddate' => '17/07/16',
          'eventtime' => null,
          'recurs' => 'None',
          'venue' => 'Phoenix Park Visitor Centre - Ashtown Castle',
          'description' => ' ',
          'fulltext' => '/en/dublin/phoenixparkvisitorcentre-ashtowncastle/events/fulldescription,36304,en.html',
          'category' => ' ',
          'maincategory' => null, ];
        //$title, $isAllDay, $start, $end, $id = null, $options
        $testEvent = [\Calendar::event($testEventData['title'], true, date_create_from_format('dd/MM/yy', $testEventData['startdate']), date_create_from_format('dd/MM/yy', $testEventData['enddate']), $testEventData['id'], $testEventData)];

        $calendar = \Calendar::addEvents($testEvent);

        $this->assertEquals($calendar, $getEvents);
    }

    public function testSet()
    {
        $events = new Events();
        $setEvents = $events->set();
        $testEventData = [
          'id' => 'd.en.36304',
          'title' => 'Feltmaking Workshops',
          'startdate' => '01/05/16',
          'enddate' => '17/07/16',
          'eventtime' => null,
          'recurs' => 'None',
          'venue' => 'Phoenix Park Visitor Centre - Ashtown Castle',
          'description' => ' ',
          'fulltext' => '/en/dublin/phoenixparkvisitorcentre-ashtowncastle/events/fulldescription,36304,en.html',
          'category' => ' ',
          'maincategory' => null, ];
        //$title, $isAllDay, $start, $end, $id = null, $options
        $testEvent = [\Calendar::event($testEventData['title'], true, date_create_from_format('dd/MM/yy', $testEventData['startdate']), date_create_from_format('dd/MM/yy', $testEventData['enddate']), $testEventData['id'], $testEventData)];

        $calendar = \Calendar::addEvents($testEvent);

        $this->assertEquals($calendar, $setEvents);
    }

    public function testParse()
    {
        $events = new Events();
        $parse = $events->parse();

        $this->assertContains('Feltmaking Workshops', $parse);
    }

    /**
     * A basic test example.
     */
    public function testLoadXml()
    {
        $events = new Events();
        $xmlFile = $events->loadXml();

        $this->assertInstanceOf('Orchestra\Parser\Xml\Document', $xmlFile);
    }

    public function testSchema()
    {
        $events = new Events();
        $schema = $events->schema();
        $testSchama = [
            'id' => ['uses' => 'item.id.a::name'],
            'title' => ['uses' => 'item.title'],
            'startdate' => ['uses' => 'item.startdate'],
            'enddate' => ['uses' => 'item.enddate'],
            'eventtime' => ['uses' => 'item.eventtime'],
            'recurs' => ['uses' => 'item.recurs'],
            'venue' => ['uses' => 'item.venue'],
            'description' => ['uses' => 'item.description'],
            'fulltext' => ['uses' => 'item.fulltext'],
            'category' => ['uses' => 'item.category'],
            'maincategory' => ['uses' => 'item.maincategory'],
        ];
        $this->assertEquals($testSchama, $schema);
    }
}
