<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Funcion que muestra todos los eventos que tengan un tema en concreto
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subject)
    {
        $subject = Subject::where('tag', $subject)->first();

        $events = $subject->events()->paginate(10);
        $titulo = "Eventos que tengan el tema ".$subject->tag;

        return view('events.allevents', [
            'titulo' => $titulo,
            'events'=> $events,

        ]);
    }

    /**
     * Muestra el formulario para crear un tema. No usado, ya que se hacer de forma asincrona
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Crea un tema nuevo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
