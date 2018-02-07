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

Route::get('/', 'PagesController@home')->name('inicio');

//Rutas de eventos
Route::get('/events/create', 'EventsController@create')->middleware('auth');
Route::get('/events/{event}', 'EventsController@show');
Route::post('/events/create', 'EventsController@store')->middleware('auth');

//Rutas de reservas
Route::get('/events/{event}/reserves', 'ReservesController@index')->middleware('auth');
Route::get('/events/{event}/reserves/{reserve}', 'ReservesController@show')->middleware('auth');
Route::get('/events/{event}/reserves/create', 'ReservesController@create')->middleware('auth');
Route::post('/events/{event}/reserves/create', 'ReservesController@store')->middleware('auth');

//Rutas de votos
Route::get('/events/{event}/votes', 'VotesController@show');
Route::get('/user/{user}/votes/create', 'VotesController@create')->middleware('auth');
Route::get('/profile/votes', 'VotesController@index')->middleware('auth');
Route::post('/user/{user}/votes/create', 'VotesController@store')->middleware('auth');

//Rutas de facturas
Route::get('/events/{event}/reserves/{reserve}/invoices/create', 'InvoicesController@create')->middleware('auth');
Route::get('/events/{event}/reserves/{reserve}/invoices', 'InvoicesController@eventinvoice')->middleware('auth');
Route::post('/events/{event}/reserves/{reserve}/invoices/create', 'InvoicesController@store')->middleware('auth');
Route::get('/profile/invoices', 'InvoicesController@index')->middleware('auth');
Route::get('/profile/invoices/{invoice}', 'InvoicesController@show')->middleware('auth');

//Rutas de lugares
Route::get('/events/{event}/places', 'PlacesController@eventplace');
Route::get('/places', 'PlacesController@index');
Route::get('/places/create', 'PlacesController@create')->middleware('auth');
Route::get('/places/{place}', 'PlacesController@show');
Route::post('/places/create', 'PlacesController@store')->middleware('auth');

//Rutas de comentarios
Route::get('/events/{event}/commentarys/', 'CommentarysController@show');
Route::get('/events/{event}/commentarys/create', 'CommentarysController@create')->middleware('auth');
Route::get('/events/{event}/commentarys/{commentary}', 'CommentarysController@eventcommentary');
Route::post('/events/{user}/commentarys/create', 'CommentarysController@store')->middleware('auth');
Route::get('/profile/commentarys', 'EventsController@index')->middleware('auth');
Route::get('/profile/commentarys/{commentary}', 'EventsController@usercommentary')->middleware('auth');

//Rutas de usuario
Route::get('/profile', 'UsersController@profile')->middleware('auth');
Route::get('/user/{user}', 'UsersController@index')->name('user.username');

Auth::routes();