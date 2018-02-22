<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Support\Facades\Auth;
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
        $reserves = $event->reserves;

        return view('reserves.show', [
            'event' => $event,
            'reserves' => $reserves
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
        $places = Place::all();

        return view('reserves.create', [
            'event' => $event,
            'places' => $places
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReserveRequest $request)
    {
        $user = Auth::user();
        $event_id = $request->input('event_id');
        dd($event_id);
        Reserve::create([
            'user_id'   => $user->id,
            'event_id'   => $event_id,
            'place'   => $request->input('place'),
            'date' => $request->input('date'),
            'cost' => $request->input('cost'),
            'units' => $request->input('units'),
        ]);

        Invoice::create([
            'user_id'   => $user->id,
            'event_id'   => $event_id,
            'buyer' => $user->username,
            'place'   => $request->input('place'),
            'date' => $request->input('date'),
            'cost' => $request->input('cost'),
            'units' => $request->input('units'),
        ]);

        return redirect("/events/$event_id/");
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
        $reserve = $event->reserves[$reserve->id];
        $invoice = Invoice::where('reserve_id', $reserve->id)->first();

        return view('reserves.showreserve', [
            'event' => $event,
            'reserve' => $reserve,
            'invoice' => $invoice
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
}
