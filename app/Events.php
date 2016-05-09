<?php

namespace HeritageCalendar;

use XmlParser;

class Events
{
    public function setEvents()
    {
        $eventsData = $this->parse();

        $events = [];

        $event = \Calendar::event($eventsData['title'], true, date_create_from_format('dd/MM/yy', $eventsData['startdate']), date_create_from_format('dd/MM/yy', $eventsData['enddate']), $eventsData['id'], $eventsData);
        array_push($events, $event);

        return $events;
    }

    public function parse()
    {
        $xml = $this->loadXml();

        return $xml->parse($this->schema());
    }

    public function loadXml()
    {
        //TODO: Details don't belong in code.
        $file = XmlParser::load(public_path('/xmldata/events/en/index.xml'));

        return $file;
    }

    public function schema()
    {
        //TODO: Details don't belong in code.
        return [
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
    }
}
