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

Route::get('/home', 'UsersController@subjectsUser')->name('inicioLogin')->middleware('auth');
Route::get('/', 'PagesController@home')->name('inicioNoLogin')->middleware('guest');
Route::get('/giveEvents/', 'EventsController@givePageEvents');
Route::get('/giveMyEvents/', 'UsersController@givePageMyEvents');
Route::post('/votar', 'VotesController@votar')->middleware('auth');
Route::post('/comentar', 'CommentarysController@comentar')->middleware('auth');
Route::post('/allcomments', 'CommentarysController@allcoments');
Route::post('/reservar', 'ReservesController@validacionAjax')->middleware('auth');
Route::post('/factura', 'InvoicesController@factura')->middleware('auth');
Route::get('/profile/events', 'UsersController@eventsProfile')->middleware('auth');
Route::get('/profile/info', 'UsersController@profileInfo')->middleware('auth');

//Rutas de eventos
Route::get('/events/', 'EventsController@index');
Route::get('/events/create', 'EventsController@create')->middleware('auth');
Route::get('/events/{event}', 'EventsController@show');
Route::post('/events/create', 'EventsController@store')->middleware('auth');

//Rutas de reservas
Route::get('/events/{event}/reserves', 'ReservesController@index')->middleware('auth');
Route::get('/events/{event}/reserves/create', 'ReservesController@create')->middleware('auth');
Route::get('/events/{event}/reserves/{reserve}', 'ReservesController@show')->middleware('auth');
Route::post('/events/{event}/reserves/create', 'ReservesController@store')->middleware('auth');

//Rutas de votos
Route::get('/events/{event}/votes/create', 'VotesController@create')->middleware('auth');
Route::get('/events/{event}/votes', 'VotesController@show');
Route::post('/events/{event}/votes/create', 'VotesController@createOrEdit')->middleware('auth');
Route::get('/profile/votes', 'VotesController@index')->middleware('auth');

//Rutas de facturas
Route::get('/profile/invoices', 'InvoicesController@index')->middleware('auth');
Route::get('/profile/invoices/{invoice}', 'InvoicesController@show')->middleware('auth');

//Rutas de lugares
Route::get('/places', 'PlacesController@index');
Route::get('/places/create', 'PlacesController@create')->middleware('auth');
Route::get('/places/{place}', 'PlacesController@show');
Route::post('/places/create', 'PlacesController@store')->middleware('auth');

//Rutas de comentarios
Route::get('/events/{event}/commentarys/create', 'CommentarysController@create')->middleware('auth');
Route::get('/events/{event}/commentarys/{commentary}', 'CommentarysController@show');
Route::post('/events/{user}/commentarys/create', 'CommentarysController@store')->middleware('auth');
Route::get('/profile/commentarys', 'CommentarysController@index')->middleware('auth');
Route::get('/profile/commentarys/{commentary}', 'EventsController@usercommentary')->middleware('auth');

//Rutas de temas
Route::get('/subjects/{subject}', 'SubjectsController@index')->middleware('auth');
Route::get('/events/{event}/subjects/create', 'SubjectsController@store')->middleware('auth');
Route::post('/profile/subjects/create', 'SubjectsController@create')->middleware('auth');

//Rutas de usuario
Route::get('/profile', 'UsersController@profile')->middleware('auth');
Route::get('/user/{user}', 'UsersController@index')->name('user.profile');

Auth::routes();