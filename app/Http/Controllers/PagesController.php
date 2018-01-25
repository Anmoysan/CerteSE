<?php

namespace App\Http\Controllers;

use App\Chusqer;
use App\Event;
use App\Evento;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Genera la página de inicio del proyecto.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(){
        $events = Event::orderBy('date', 'asc')->paginate(10);

        return view('home', [
            'events' => $events
        ]);
    }
}
