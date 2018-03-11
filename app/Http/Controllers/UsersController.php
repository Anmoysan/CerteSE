<?php

namespace App\Http\Controllers;

use App\Event;
use App\Subject;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UsersController extends Controller
{
    /**
     * Muestra los eventos creados por el usuario
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
     * Lanza uno de los formularios que tu seleccionas
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Actualiza el usuario con una de la funciones que has solucionado
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $path = $request->path();
        $user = Auth::user();


        if (strpos($path, 'account')) {
            $data = array_filter($request->all());

            $user = User::findOrFail(Auth::user()->id);

            $user->fill($data);
        } elseif (strpos($path, 'password')) {

            if (!Hash::check($request->get('current_password'), $user->password)) {
                return redirect()->back()->with('error', 'La contraseña actual no es correcta');
            }

            if (strcmp($request->get('current_password'), $request->get('password')) == 0) {
                return redirect()->back()->with('error', 'La nueva contraseña debe ser diferente de la antigua.');
            }

            $user->password = bcrypt($request->get('password'));
        } elseif (strpos($path, 'avatar')) {

            $avatar = $request->file('avatar');

            $url = $avatar->store('image', 'public');

            $user = User::findOrFail(Auth::user()->id);

            $user->avatar = $url;
        }

        $user->save();

        return redirect()
            ->back()
            ->with('exito', 'Datos actualizados');
    }

    /**
     * Elimina al usuario con el que estas logueado
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::user()->delete();

        return redirect('/');
    }

    /**
     * Muestra el perfil del usuario, pero los datos son mostrados con asincronia por lo que si lo tienes desactivado no podras usarlo adecuadamente
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

    /**
     * Muestra la configuracion del perfil
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function configuration()
    {
        return view('users.edit');
    }

    /**
     * Funcion asincrona que da la informacion del usuario logueado
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileInfo()
    {
        $user = Auth::user();

        return view('users.infoUser', [
            'user' => $user,
        ]);
    }

    /**
     * Funcion asincrona que da los eventos del usuario logueado
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
     * Metodo que muestra todos los eventos con algun tema en comun al del usuario
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

    /**
     * Funcion que se usa para convertir una collection a Pagination, permitiendo asi usar pagination en la pagina
     * El pagination del html funciona con asincronismo
     *
     * @param $items
     * @param $perPage
     * @return LengthAwarePaginator
     */
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

    /**
     * Funcion asincrona que carga mas eventos del usuario logueado
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function givePageMyEvents()
    {
        if (request()->ajax()) {
            $user = Auth::user();
            $events = $user->events()->paginate(10);

            //dd(Event::whereIn('id', $reserves)->paginate(10));

            return View::make('users.eventsProfile', array('events' => $events, 'user' => $user))->render();
        } else {
            return redirect('/');
        }
    }

    /**
     * Funcion asincrona que carga mas eventos con algun tema igual al del usuario logueado
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
