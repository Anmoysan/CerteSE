<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEventRequest;
use App\Place;
use App\Event;
use App\Http\Requests\CreateEventRequest;
use App\Vote;
use App\Commentary;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class EventsController extends Controller
{

    /**
     * Metodo que muestra todos los eventos con fecha despues de la de hoy
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $events = Event::orderBy('date', 'asc')->where('date', '>', now())->paginate(10);
        $titulo = "Proximos eventos";

        return view('events.allevents', [
            'titulo' => $titulo,
            'events' => $events
        ]);
    }

    /**
     * Método que muestra la información de un evento y todos su votos, lugar y comentarios
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event)
    {
        $user = Auth::user();
        $event = Event::where('id', $event->id)->first();
        $place = Place::where('id', $event->place_id)->first();
        $commentarys = Commentary::where('event_id', $event->id)->orderBy('created_at', 'desc')->paginate(10);
        $votesTotal = $event->votesMean();

        return view('events.cargeshow', [
            'user' => $user,
            'event' => $event,
            'place' => $place,
            'commentarys' => $commentarys,
            'votesTotal' => $votesTotal
        ]);
    }

    /**
     * Método para mostrar el formulario crear un nuevo evento
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $places = Place::all();
        $user = Auth::user();

        return view('events.create', [
            'places' => $places,
            'user' => $user
        ]);
    }

    /**
     * Crea un objeto evento
     *
     * @param CreateEventRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateEventRequest $request)
    {

        $user = $request->user();
        $place = Place::where('id', $request->input('place'))->first();
        $date = new DateTime($request->input('date'));
        $date->format('d-m-Y');

        Event::create([
            'user_id' => $user->id,
            'place_id' => $place->id,
            'name' => $request->input('name'),
            'image' => $request->input('image'),
            'place' => $place->name,
            'subject' => ""/*$request->input('subject')*/,
            'date' => $date,
            'duration' => $request->input('duration'),
            'cost' => $request->input('cost'),
            'agemin' => $request->input('agemin'),
            'organizer' => $request->input('organizer'),
            'commentarys' => $request->input('commentarys') == 1 ? true : false
        ]);

        return redirect('/');
    }

    /**
     * Reenvia al formulario de edicion de evento
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $places = Place::all();
        $event = Event::where('id', $id)->first();

        return view('events.edit', ['event' => $event, 'places' => $places]);
    }

    /**
     * Actualiza los datos del usuario especificado
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $data = array_filter($request->all());
        $event = Event::findOrFail($id);
        $event->fill($data);

        $event->save();

        return redirect()
            ->back()
            ->with('exito', 'Datos actualizados');
    }

    /**
     * Funcion que elimina un evento creado
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Event::where('id', $id)->delete();

        return redirect('/');
    }

    /**
     * Funcion asincrona que permite
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function givePageEvents()
    {
        if (request()->ajax()) {
            $events = Event::orderBy('date', 'asc')->where('date', '>', now())->paginate(10);

            return View::make('events.listaevents', array('events' => $events))->render();
        } else {
            return redirect('/');
        }
    }
}