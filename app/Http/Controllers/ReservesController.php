<?php

namespace App\Http\Controllers;

use App\Event;
use App\Place;
use App\Reserve;
use App\Http\Requests\CreateReserveRequest;
use Illuminate\Http\Request;

class ReservesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $event = Event::where('id', $event->id)->first();
        $reserve = Reserve::where('event_id', $event->id)->first();

        return view('reserves.show', [
            'event' => $event,
            'reserve' => $reserve
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $event = Event::where('id', $event->id)->first();

        return view('reserve.create', [
            'event' => $event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReserveRequest $request, Event $event)
    {
        $user = Auth::user();
        $event = Event::where('id', $event->id)->first();
        $place = Place::where('id', $event->place_id)->first();

        Reserve::create([
            'user_id'   => $user->id,
            'event_id'   => $event->id,
            'place'   => $place->coordinate,
            'date' => $request->input('date'),
            'cost' => $request->input('cost'),
            'units' => $request->input('units'),
        ]);

        return redirect("/events/$event->id/reserves");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Reserve $reserve)
    {
        $event = Event::where('id', $event->id)->first();
        $reserve = Reserve::where('event_id', $event->id)->where('id', $reserve)->first();

        return view('reserves.show', [
            'event' => $event,
            'reserve' => $reserve
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Muestra las reservas que existen de un evento en un lugar
     *
     * @param Event $event
     * @param Place $place
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function placereserve(Event $event, Place $place)
    {
        $event = Event::where('id', $event->id)->first();
        $place = Place::where('id', $place->id)->first();
        $reserve = Reserve::where('event_id', $event->id)->where('place_id', $place->id)->lastest();

        return view('reserve.place', [
            'event' => $event,
            'place' => $place,
            'reserve' => $reserve
        ]);
    }
}
