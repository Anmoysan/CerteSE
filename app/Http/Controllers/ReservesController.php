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
    public function store(CreateReserveRequest $request, Event $event)
    {
        $user = Auth::user();
        $event_id = Event::where('id', $event->id)->first();
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

    public function votar(CreateReserveRequest $request)
    {
        if (request()->ajax()) {
            $data = json_decode(file_get_contents("php://input"), true);
            $event_id = $data['event_id'];
            $event = Event::where('id', $event_id)->first();
            $place = Place::where('id', $event->place_id)->first();
            $commentarys = $event->commentaries;

            $this->store($request, $event);

            $votesTotal = $event->votesMean();

            return View::make('events.show', [
                'event' => $event,
                'place' => $place,
                'commentarys' => $commentarys,
                'votesTotal' => $votesTotal
            ])->render();
        } else {
            return redirect('/');
        }
    }
}
