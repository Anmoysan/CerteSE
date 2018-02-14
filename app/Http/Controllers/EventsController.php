<?php

namespace App\Http\Controllers;

use App\Place;
use App\Event;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Método que muestra la información de un mensaje. Utiliza Route Binding
     * para coneguir el Event facilitado por el parámetro.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event)
    {
        $event = Event::where('id', $event->id)->first();
        $place = Place::where('id', $event->place_id)->first();
        $commentarys = $event->commentaries;

        $votesTotal = $event->votesMean();

        return view('events.show', [
            'event' => $event,
            'place' => $place,
            'commentarys' => $commentarys,
            'votesTotal' => $votesTotal
        ]);
    }

    /**
     * Método para mostrar el formulario de alta de una nuevo mensaje Event.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $places = Place::all();

        return view('events.create', [
            'places' => $places
        ]);
    }

    /**
     * Guarda en la base de datos la información facilitada para un nuevo mensaje.
     * Utiliza la definición personalizada de un Request para validar los datos.
     *
     * @param CreateEventRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateEventRequest $request){

        $user = $request->user();
        $place = Place::where('id', $request->input('place'))->first();

        Event::create([
            'user_id'   => $user->id,
            'place_id'   => $place->id,
            'name' =>  $request->input('name'),
            'image' => $request->input('image'),
            'place' => $place->name,
            'subject' => $request->input('subject'),
            'date' => $request->input('date'),
            'duration' => $request->input('duration'),
            'cost' => $request->input('cost'),
            'agemin' => $request->input('agemin'),
            'organizer' => $request->input('organizer'),
            'commentarys' => $request->input('commentarys')==1 ? true : false
        ]);

        return redirect('/');
    }
}
