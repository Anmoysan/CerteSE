<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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

    public function givePageEvents(){
        if (request()->ajax()){
            $events = Event::orderBy('date', 'asc')->where('date', '>', now())->paginate(10);

            return View::make('events.listaevents', array('events' => $events))->render();
        }else{
            return redirect('/');
        }
    }
}
