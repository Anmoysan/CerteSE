<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Genera la página de inicio del proyecto.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(){
        $events = Event::orderBy('date', 'asc')->where('date', '>', now())->paginate(9);

        return view('home', [
            'events' => $events
        ]);
    }
}
