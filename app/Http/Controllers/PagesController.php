<?php

namespace App\Http\Controllers;

use App\Event;
use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Genera la página de inicio del proyecto.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(){
        $events = Event::orderBy('date', 'asc')->where('date', '>', now())->paginate(10);
        $user = Auth::user();

        return view('home', [
            'events' => $events,
            'user' => $user
        ]);
    }
}
