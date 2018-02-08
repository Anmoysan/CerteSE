<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Commentary;
use App\Http\Requests\CreateCommentaryRequest;
use Illuminate\Http\Request;

class CommentarysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $commentarys = $user->commentaries;

        return view('users.commentarys', [
            'user'      => $user,
            'commentarys' => $commentarys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
     * Error al crear un comentario por evento que es nulo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentaryRequest $request, Event $event)
    {
        $user = $request->user();
        $event = Event::where('id', $event->id)->first();

        dd($event);
        Commentary::create([
            'user_id'   => $user->id,
            'event_id'   => $event->id,
            'content' =>  $request->input('content'),
        ]);

        return redirect("/events/$event->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Commentary $commentary)
    {
        $event = Event::where('id', $event->id)->first();
        $commentarys = $event->commentaries;
        $posicion = 0;

        foreach ($commentarys as $indice=>$commentar) {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Muestra un comentario en especifico de un usuario
     *
     * @param Commentary $commentary
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usercommentary(Commentary $commentary)
    {
        $user = Auth::user();
        $commentarys = $user->commentaries;
        $posicion = 0;

        foreach ($commentarys as $indice=>$commentar) {
            if ($commentar->id == $commentary->id) {
                $commentarys = $commentar;
                $posicion = $indice;
            }
        }

        return view('users.commentarys', [
            'user'      => $user,
            'commentarys' => $commentarys,
            'posicion' => $posicion
        ]);
    }
}
