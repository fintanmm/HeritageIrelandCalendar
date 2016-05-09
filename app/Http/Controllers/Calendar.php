<?php

namespace HeritageCalendar\Http\Controllers;

use HeritageCalendar\Events;

class Calendar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = new Events();
        $calendar = $events->get();

        return view('calendar', compact('calendar'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
