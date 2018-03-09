<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home')->name('inicioNoLogin')->middleware('guest');

//Rutas asincronas
Route::get('/giveEvents/', 'EventsController@givePageEvents');
Route::get('/giveMyEvents/', 'UsersController@givePageMyEvents');
Route::get('/giveEventsMySubject/', 'UsersController@givePageSubjectEvents');
Route::post('/allcomments', 'CommentarysController@allcoments');

//Rutas de eventos
Route::get('/events/', 'EventsController@index');
Route::get('/events/{event}', 'EventsController@show');

//Rutas de votos
Route::get('/events/{event}/votes', 'VotesController@show');

//Rutas de lugares
Route::get('/places', 'PlacesController@index');
Route::get('/places/{place}', 'PlacesController@show');

//Rutas de comentarios
Route::get('/events/{event}/commentarys/{commentary}', 'CommentarysController@show');

//Rutas de usuario
Route::get('/user/{user}', 'UsersController@index')->name('user.profile');


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'UsersController@subjectsUser')->name('inicioLogin');

    //Rutas asincronas
    Route::post('/votar', 'VotesController@votar');
    Route::post('/comentar', 'CommentarysController@comentar');
    Route::post('/reservar', 'ReservesController@validacionAjax');
    Route::post('/factura', 'InvoicesController@factura');
    Route::get('/profile/events', 'UsersController@eventsProfile');
    Route::get('/profile/info', 'UsersController@profileInfo');

    //Rutas de eventos
    Route::get('/events/create', 'EventsController@create');
    Route::post('/events/create', 'EventsController@store');

    //Rutas de reservas
    Route::get('/events/{event}/reserves', 'ReservesController@index');
    Route::get('/events/{event}/reserves/create', 'ReservesController@create');
    Route::get('/events/{event}/reserves/{reserve}', 'ReservesController@show');
    Route::post('/events/{event}/reserves/create', 'ReservesController@store');

    //Rutas de votos
    Route::get('/events/{event}/votes/create', 'VotesController@create');
    Route::post('/events/{event}/votes/create', 'VotesController@store');
    Route::get('/profile/votes', 'VotesController@index');

    //Rutas de facturas
    Route::get('/profile/invoices', 'InvoicesController@index');
    Route::get('/profile/invoices/{invoice}', 'InvoicesController@show');

    //Rutas de lugares
    Route::get('/places/create', 'PlacesController@create');
    Route::post('/places/create', 'PlacesController@store');

    //Rutas de comentarios
    Route::get('/events/{event}/commentarys/create', 'CommentarysController@create');
    Route::post('/events/{user}/commentarys/create', 'CommentarysController@store');
    Route::get('/profile/commentarys', 'CommentarysController@index')->middleware('auth');
    Route::get('/profile/commentarys/{commentary}', 'EventsController@usercommentary');

    //Rutas de temas
    Route::get('/subjects/{subject}', 'SubjectsController@index');
    Route::get('/events/{event}/subjects/create', 'SubjectsController@store');
    Route::post('/profile/subjects/create', 'SubjectsController@create');

    //Rutas de usuario
    Route::get('/profile', 'UsersController@profile');
});