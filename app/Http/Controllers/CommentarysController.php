<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Commentary;
use App\Place;
use App\Http\Requests\CreateCommentaryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CommentarysController extends Controller
{

    /**
     * Muestra todos los comentarios realizados por el usuario loggueado
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $commentarys = $user->commentaries;

        return view('users.commentarys', [
            'user' => $user,
            'commentarys' => $commentarys,
        ]);
    }

    /**
     * Devuelve la vista de formulario para crear un comentario.
     * Actualmente en deshuso ya que se crea a traves de la funcion asincrona comentar y se ejecuta en la vista show del evento
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $event = Event::where('id', $event->id)->first();

        return view('commentarys.create', [
            'event' => $event
        ]);
    }

    /**
     * Permite crear un comentario, es necesario pasarle un evento con el que estara relacionado
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentaryRequest $request, Event $event)
    {
        $user = $request->user();
        $event = Event::where('id', $event->id)->first();

        Commentary::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'content' => $request->input('content'),
        ]);

        return redirect("/events/" . $request->input('event_id'));
    }

    /**
     * Muestra un comentario en especifico de un evento
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Commentary $commentary)
    {
        $event = Event::where('id', $event->id)->first();
        $commentarys = $event->commentaries;
        $posicion = 0;

        foreach ($commentarys as $indice => $commentar) {
            if ($commentar->id == $commentary->id) {
                $commentary = $commentar;
                $posicion = $indice;
            }
        }

        return view('commentarys.show', [
            'event' => $event,
            'commentary' => $commentary,
            'posicion' => $posicion
        ]);
    }

    /**
     * Funcion que mostrara un input con los datos. En deshuso ya que se hara de forma asincrona
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commentary = Commentary::where('id', $id)->first();
        $event = $commentary->event;

        return view('commentarys.edit', ['event' => $event, 'commentary' => $commentary]);
    }

    /**
     * Modifica el comentario seleccionado
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_filter($request->all());
        $commentary = Commentary::findOrFail($id);
        $commentary->fill($data);

        $commentary->save();

        return redirect()
            ->back()
            ->with('exito', 'Datos actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentary = Commentary::where('id', $id)->first();
        $event = $commentary->event;
        $commentary->delete();

        return redirect("/events/".$event->id);
    }

    /**
     * Muestra un comentario en especifico del usuario loggueado
     *
     * @param Commentary $commentary
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usercommentary(Commentary $commentary)
    {
        $user = Auth::user();
        $commentarys = $user->commentaries;
        $posicion = 0;

        foreach ($commentarys as $indice => $commentar) {
            if ($commentar->id == $commentary->id) {
                $commentarys = $commentar;
                $posicion = $indice;
            }
        }

        return view('users.commentarys', [
            'user' => $user,
            'commentarys' => $commentarys,
            'posicion' => $posicion
        ]);
    }

    /**
     * Funcion que permite la creacion de comentario, pero los datos se pasan a traves de funcion asincrona
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroycomment()
    {
        if (request()->ajax()) {
            $data = json_decode(file_get_contents("php://input"), true);
            $event_id = $data['event_id'];
            $comment_id = $data['comment_id'];
            $user = Auth::user();
            $event = Event::where('id', $event_id)->first();
            $place = Place::where('id', $event->place_id)->first();

            $this->destroy($comment_id);

            $votesTotal = $event->votesMean();
            $commentarys = Commentary::where('event_id', $event->id)->orderBy('created_at', 'desc')->paginate(10);

            return View::make('events.show', [
                'user' => $user,
                'event' => $event,
                'place' => $place,
                'commentarys' => $commentarys,
                'votesTotal' => $votesTotal
            ])->render();
        } else {
            return redirect('/');
        }
    }

    /**
     * Funcion que permite la eliminacion de un comentario, pero los datos se pasan a traves de funcion asincrona
     *
     * @param CreateCommentaryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function comentar(CreateCommentaryRequest $request)
    {
        if (request()->ajax()) {
            $data = json_decode(file_get_contents("php://input"), true);
            $event_id = $data['event_id'];
            $user = Auth::user();
            $event = Event::where('id', $event_id)->first();
            $place = Place::where('id', $event->place_id)->first();

            $this->store($request, $event);

            $votesTotal = $event->votesMean();
            $commentarys = Commentary::where('event_id', $event->id)->orderBy('created_at', 'desc')->paginate(10);

            return View::make('events.show', [
                'user' => $user,
                'event' => $event,
                'place' => $place,
                'commentarys' => $commentarys,
                'votesTotal' => $votesTotal
            ])->render();
        } else {
            return redirect('/');
        }
    }

    /**
     * Funcion asincrona que devulve todos los comentarios
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function allcoments()
    {
        if (request()->ajax()) {
            $this->showAllComments = false;
            $data = json_decode(file_get_contents("php://input"), true);
            $event_id = $data['event_id'];

            $user = Auth::user();
            $event = Event::where('id', $event_id)->first();
            $place = Place::where('id', $event->place_id)->first();
            $votesTotal = $event->votesMean();
            $commentarys = $event->commentaries;

            return View::make('events.show', [
                'user' => $user,
                'event' => $event,
                'place' => $place,
                'commentarys' => $commentarys,
                'votesTotal' => $votesTotal
            ])->render();
        } else {
            return redirect('/');
        }
    }
}
