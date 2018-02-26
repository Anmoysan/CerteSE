<?php

namespace App\Http\Controllers;

use App\Place;
use App\Event;
use App\Http\Requests\CreateEventRequest;
use App\Vote;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class EventsController extends Controller
{

    /**
     * Metodo que muestra todos los eventos
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $events = Event::orderBy('date', 'asc')->where('date', '>', now())->paginate(10);

        return view('events.allevents', [
            'events' => $events
        ]);
    }

    /**
     * Método que muestra la información de un mensaje. Utiliza Route Binding
     * para coneguir el Event facilitado por el parámetro.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event)
    {
        $user = Auth::user();
        $event = Event::where('id', $event->id)->first();
        $place = Place::where('id', $event->place_id)->first();
        $commentarys = $event->commentaries;
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
        $date = new DateTime($request->input('date'));
        $date->format('d-m-Y');

        Event::create([
            'user_id'   => $user->id,
            'place_id'   => $place->id,
            'name' =>  $request->input('name'),
            'image' => $request->input('image'),
            'place' => $place->name,
            'subject' => $request->input('subject'),
            'date' => $date,
            'duration' => $request->input('duration'),
            'cost' => $request->input('cost'),
            'agemin' => $request->input('agemin'),
            'organizer' => $request->input('organizer'),
            'commentarys' => $request->input('commentarys')==1 ? true : false
        ]);

        return redirect('/');
    }

    public function givePageEvents(){
        if (request()->ajax()){
            $events = Event::orderBy('date', 'asc')->where('date', '>', now())->paginate(10);

            return View::make('events.listaevents', array('events' => $events))->render();
        }else{
            return redirect('/');
        }
    }
}