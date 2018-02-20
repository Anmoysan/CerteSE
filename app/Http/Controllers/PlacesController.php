<?php

namespace App\Http\Controllers;

use App\Event;
use App\Place;
use App\Http\Requests\CreatePlaceRequest;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::orderBy('name', 'asc')->paginate(9);

        return view('places.index', [
            'places'      => $places
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Error al crear un nuevo lugar por la description
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlaceRequest $request)
    {
        Place::create([
            'name' =>  $request->input('name'),
            'image' => $request->input('image'),
            'description' => $request->input('description'),
            'coordinate' => $this->placeCalcule($request)
        ]);

        return redirect('/places');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        $place = Place::where('id', $place->id)->first();

        return view('places.show', [
            'place'      => $place
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
     * Transforma latitud y longitud en un solo campo
     *
     * @param CreatePlaceRequest $request
     * @return string
     */
    public function placeCalcule(CreatePlaceRequest $request){
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        return "$latitud, $longitud";
    }

    public function votar(){
        if (request()->ajax()) {
            //Dar votaciones

            return View::make('', array('events' => $events))->render();
        } else {
            return redirect('/');
        }
    }
}
