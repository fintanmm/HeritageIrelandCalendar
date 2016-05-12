<?php

namespace HeritageCalendar;

class Events
{
    public function get()
    {
        return $this->set();
    }

    public function set()
    {
        $parseEvent = $this->parse();

        $events = [];
        for ($i = 0; $i < count($parseEvent); $i++) {
            $events[$i] = \Calendar::event($parseEvent[$i]['title'], true, date_create_from_format('dd/MM/yy', $parseEvent[$i]['start']), date_create_from_format('dd/MM/yy', $parseEvent[$i]['end']), $parseEvent[$i]['id'], $parseEvent[$i]);
        }

        return \Calendar::addEvents($events);
    }

    public function parse()
    {
        $xml = $this->loadXml();
        $queryp = qp($xml, 'item');
        $i = 0;
        $parseEvent = [];

        foreach ($queryp as $child) {
            foreach ($this->schema() as $key => $value) {
                if ($child->find($key)->hasAttr('name')) {
                    $parseEvent[$i][$value] = $child->find($key)->attr('name');
                } else {
                    $parseEvent[$i][$value] = $child->children($key)->text();
                }
            }
            $i++;
        }

        return $parseEvent;
    }

    public function loadXml()
    {
        //TODO: Details don't belong in code.
        return public_path('/xmldata/events/en/index.xml');
    }

    public function schema()
    {
        //TODO: Details don't belong in code.
        return [
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
    }
}
