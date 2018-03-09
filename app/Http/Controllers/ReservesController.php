<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReserveAjaxRequest;
use App\Invoice;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Place;
use App\Reserve;
use App\Http\Requests\CreateReserveFormAjaxRequest;
use Illuminate\Http\Request;

class ReservesController extends Controller
{
    /**
     * Muestra todas las reservas de un evento. Por ahora en deshuso, más adelante solo accedera el creador del evento
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
     * Funcion que lanza el formulario de reserva. No se usa, ya que se lanza el formulario de forma asincrona
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
     * Permite crear tanto reservas como factura para asi automatizar la creacion de factura cuando alguien haga una reserva
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReserveAjaxRequest $request, Event $event)
    {
        $user = Auth::user();
        $event = Event::where('id', $event->id)->first();
        Reserve::create([
            'user_id'   => $user->id,
            'event_id'   => $event->id,
            'place'   => $request->input('place'),
            'date' => $request->input('fecha'),
            'cost' => (double)$request->input('cost'),
            'units' => (int)$request->input('unidad'),
        ]);


        $reserve = Reserve::where('user_id', $user->id)->where('event_id', $event->id)->first();

        Invoice::create([
            'user_id'   => $user->id,
            'reserve_id'   => $event->id,
            'buyer' => $user->username,
            'place'   => $request->input('place'),
            'date' => $request->input('fecha'),
            'cost' => $request->input('cost'),
            'units' => $request->input('unidad'),
        ]);

        return redirect("/events/$event->id/");
    }

    /**
     * Muestra una reserva en concreto de un evento. Por ahora en deshuso, más adelante solo accedera el creador del evento
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

    /**
     * Funcion asincrona que valida el formulario de reserva
     *
     * @param CreateReserveFormAjaxRequest $request
     * @return array
     */
    protected function validacionAjax(CreateReserveFormAjaxRequest $request){
        //Obtenermos todos los valores y devolvemos un array vacio
        return array();
    }
}
