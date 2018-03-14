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
Route::post('/registro', 'Auth\RegisterController@validacionAjax');

//Rutas de eventos
Route::get('/events/create', 'EventsController@create')->middleware('auth');
Route::post('/events/create', 'EventsController@store')->middleware('auth');
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
    Route::post('/deletecomment', 'CommentarysController@destroycomment');
    Route::post('/reservar', 'ReservesController@validacionAjax');
    Route::post('/factura', 'InvoicesController@factura');
    Route::get('/profile/events', 'UsersController@eventsProfile');
    Route::get('/profile/info', 'UsersController@profileInfo');

    //Rutas de eventos
    Route::get('/events/{event}/edit', 'EventsController@edit');
    Route::patch('/events/{event}/edit', 'EventsController@update');
    Route::delete('/events/{event}/delete', 'EventsController@destroy')->name('event.delete');

    //Rutas de reservas
    Route::get('/events/{event}/reserves', 'ReservesController@index');
    Route::get('/events/{event}/reserves/create', 'ReservesController@create');
    Route::get('/events/{event}/reserves/{reserve}', 'ReservesController@show');
    Route::post('/events/{event}/reserves/create', 'ReservesController@store');
    Route::get('/reserves/{reserve}/edit', 'ReservesController@edit');
    Route::patch('/reserves/{reserve}/edit', 'ReservesController@update');
    Route::delete('/reserves/{reserve}/delete', 'ReservesController@destroy')->name('reserve.delete');

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
    Route::get('/places/{place}/edit', 'PlacesController@edit');
    Route::patch('/places/{place}/edit', 'PlacesController@update');
    Route::delete('/places/{place}/delete', 'PlacesController@destroy')->name('place.delete');

    //Rutas de comentarios
    Route::get('/events/{event}/commentarys/create', 'CommentarysController@create');
    Route::post('/events/{user}/commentarys/create', 'CommentarysController@store');
    Route::get('/profile/commentarys', 'CommentarysController@index')->middleware('auth');
    Route::get('/profile/commentarys/{commentary}', 'EventsController@usercommentary');
    Route::get('/commentarys/{commentary}/edit', 'CommentarysController@edit');
    Route::patch('/commentarys/{commentary}/edit', 'CommentarysController@update');
    Route::delete('/commentarys/{commentary}/delete', 'CommentarysController@destroy')->name('commentary.delete');

    //Rutas de temas
    Route::get('/subjects/{subject}', 'SubjectsController@index');
    Route::get('/events/{event}/subjects/create', 'SubjectsController@store');
    Route::post('/profile/subjects/create', 'SubjectsController@create');

    //Rutas de usuario
    Route::get('/profile', 'UsersController@profile');
    Route::get('/profile/configuration', 'UsersController@configuration');
    Route::get('/profile/configuration/account', 'UsersController@edit')->name('profile.account');
    Route::patch('/profile/configuration/account', 'UsersController@update');
    Route::get('/profile/configuration/password', 'UsersController@edit')->name('profile.password');
    Route::patch('/profile/configuration/password', 'UsersController@update');
    Route::get('/profile/configuration/avatar', 'UsersController@edit')->name('profile.avatar');
    Route::patch('/profile/configuration/avatar', 'UsersController@update');
    Route::get('/profile/configuration/delete', 'UsersController@edit')->name('profile.delete');
    Route::delete('/profile/configuration/delete', 'UsersController@destroy');
});