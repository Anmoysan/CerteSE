<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReserveAjaxRequest;
use App\Http\Requests\UpdateReserveRequest;
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
            'reserve_id'   => $reserve->id,
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
     * Funcion que lanza el formulario de modificar reserva. Se hace a traves de modal y forma asincrona
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $reserve = Reserve::where('id', $id)->first();
        $event = $reserve->event;
        $places = Place::all();

        return view('reserves.edit', ['event' => $event, 'reserve' => $reserve, 'places' => $places]);
    }

    /**
     * Actualiza la reserva y factura
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReserveRequest $request, $id)
    {
        $data = array_filter($request->all());
        $reserve = Reserve::findOrFail($id);
        $reserve->fill($data);
        $reserve->save();

        $invoice = Invoice::where('reserve_id', $id)->where('user_id', Auth::user()->id)->first();
        $invoice->fill($data);
        $invoice->save();


        return redirect()
            ->back()
            ->with('exito', 'Datos actualizados');
    }

    /**
     * Funcion que elimina tanto una reserva como dicha factura
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $event = Event::where('id', $id)->first();
        $reserves = $event->reserves;
        foreach ($reserves as $reserve) {
            Invoice::where('reserve_id', $reserve->id)->first()->delete();
            $reserve->delete();
        }

        return redirect("/events/".$id);
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
