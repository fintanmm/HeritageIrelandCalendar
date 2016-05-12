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
        $testEvent = [\Calendar::event($testEventData['title'], true, date_create_from_format('j/m/y', $testEventData['startdate']), date_create_from_format('j/m/y', $testEventData['enddate']), $testEventData['id'], $testEventData)];

        $calendar = \Calendar::addEvents($testEvent);

        $this->assertEquals($calendar, $setEvents);
    }

    public function testFormatDate()
    {
        $events = new Events();
        $formatDate = $events->formatDate('01/05/16');
        $testDate = date_create_from_format('j/m/y', '01/05/16');

        $this->assertEquals($testDate, $formatDate);
    }

    public function testParse()
    {
        $events = new Events();
        $parse = $events->parse();

        $this->assertContains('Feltmaking Workshops', $parse[0]);
    }

    /**
     * A basic test example.
     */
    public function testLoadXml()
    {
        $xml = public_path('/xmldata/events/en/index.xml');
        $events = new Events();
        $xmlFile = $events->loadXml();

        $this->assertEquals($xml, $xmlFile);
    }

    public function testSchema()
    {
        $events = new Events();
        $schema = $events->schema();
        $testSchema = [
            'id>a' => 'id',
            'title' => 'title',
            'startdate' => 'start',
            'enddate' => 'end',
            'eventtime' => '',
            'recurs' => 'recurs',
            'venue' => 'venue',
            'description' => 'description',
            'fulltext' => 'url',
            'category' => 'category',
            'maincategory' => 'maincategory',
        ];
        $this->assertEquals($testSchema, $schema);
    }

    public function testQueryPath()
    {
        //This is more of a scratchpad.
        $testSchema = [
            'id>a' => 'id',
            'title' => 'title',
            'startdate' => 'start',
            'enddate' => 'end',
            'eventtime' => 'eventtime',
            'recurs' => 'recurs',
            'venue' => 'venue',
            'description' => 'description',
            'fulltext' => 'url',
            'category' => 'category',
            'maincategory' => 'maincategory',
        ];
        $eventData = [];

        $xml = public_path('/xmldata/events/en/index.xml');
        $queryp = qp($xml, 'item');
        $i = 0;
        foreach ($queryp as $child) {
            foreach ($testSchema as $key => $value) {
                if ($child->find($key)->hasAttr('name')) {
                    $eventData[$i][$value] = $child->find($key)->attr('name');
                } else {
                    $eventData[$i][$value] = $child->children($key)->text();
                }
            }
            $i++;
        }
    }
}
