<?php

namespace App\Http\Controllers;

use App\Event;
use App\Place;
use App\Http\Requests\CreatePlaceRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PlacesController extends Controller
{
    /**
     * Muestra todos los lugares que existen en la aplicacion
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
     * Envia al formulario de creacion de un lugar
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create', [

        ]);
    }

    /**
     * Crea un lugar
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
     * Muestra los datos de un lugar creado
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
     * Funcion que lanza el formulario para actualizar el lugar
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::where('id', $id)->first();

        return view('places.edit', ['place' => $place]);
    }

    /**
     * Actualiza el lugar indicado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array_filter($request->all());
        $place = Place::findOrFail($id);
        $place->fill($data);

        $place->save();

        return redirect()
            ->back()
            ->with('exito', 'Datos actualizados');
    }

    /**
     * Permite eliminar un lugar existente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Place::where('id', $id)->delete();

        return redirect('/places');
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
}
