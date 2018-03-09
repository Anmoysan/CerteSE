<?php

namespace App\Http\Controllers;

use App\Event;
use App\Subject;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    /**
     * Muestra los eventos creados por los usuarios
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        $user = User::where('username', $name)->first();
        $events = $user->events()->latest()->paginate(10);

        return view('users.eventsUser', [
            'userSearch' => $user,
            'user' => $user,
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->user->delete();

        return redirect()->route('home');
    }

    /**
     * Muestra el perfil del usuario
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();

        return view('users.profile', [
            'user' => $user,
        ]);
    }

    public function profileInfo()
    {

        $user = Auth::user();

        return view('users.infoUser', [
            'user' => $user,
        ]);
    }

    public function eventsProfile()
    {
        $user = Auth::user();
        $events = $user->events()->paginate(10);

        //dd(Event::whereIn('id', $reserves)->paginate(10));

        return view('users.eventsProfile', [
            'user' => $user,
            'events' => $events,
        ]);
    }

    /**
     * Metodo que muestra todos los eventos
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subjectsUser()
    {

        $eventsFull = null;
        $user = Auth::user();
        $subjects = $user->subjects()->get();
        //dd(Event::subject($user)->get());
        //$events = Event::subject($user)->where('date', '>', now())->paginate(10);
        foreach ($subjects as $subject) {
            $eventos = $subject->events()->where('date', '>', now())->get();
            if($eventsFull === null){
                $eventsFull = $eventos;
            }else{
                $eventsFull = $eventsFull->union($eventos);
                $eventsFull->all();
            }
        }
        $events = $this->paginate($eventsFull, 10);
        //$events = $eventsFull->forPage(1, 10)->get();
        //dd($events);
        //$events = $eventsFirst;

        return view('users.eventsSubjectUser', [
            'events' => $events
        ]);
    }

    public function paginate($items, $perPage)
    {
        if(is_array($items)){
            $items = collect($items);
        }

        return new LengthAwarePaginator(
            $items->forPage(Paginator::resolveCurrentPage() , $perPage),
            $items->count(), $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
    }

    public function eventsUser()
    {
        $user = Auth::user();
        $events = $user->events()->paginate(10);

        //dd(Event::whereIn('id', $reserves)->paginate(10));

        return view('users.eventsUser', [
            'user' => $user,
            'events' => $events,
        ]);
    }

    public function givePageMyEvents()
    {
        if (request()->ajax()) {
            $user = Auth::user();
            $events = $user->events()->paginate(10);

            //dd(Event::whereIn('id', $reserves)->paginate(10));

            return View::make('events.listaevents', array('events' => $events))->render();
        } else {
            return redirect('/');
        }
    }

    public function givePageSubjectEvents()
    {
        if (request()->ajax()) {
            $eventsFull = null;
            $user = Auth::user();
            $subjects = $user->subjects()->get();
            //dd(Event::subject($user)->get());
            //$events = Event::subject($user)->where('date', '>', now())->paginate(10);
            foreach ($subjects as $subject) {
                $eventos = $subject->events()->where('date', '>', now())->get();
                if($eventsFull === null){
                    $eventsFull = $eventos;
                }else{
                    $eventsFull = $eventsFull->union($eventos);
                    $eventsFull->all();
                }
            }
            $events = $this->paginate($eventsFull, 10);


            return View::make('events.listaevents', array('events' => $events))->render();
        } else {
            return redirect('/');
        }
    }
}
