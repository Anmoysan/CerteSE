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
Route::get('/user/{user}/reserves/create', 'ReservesController@create')->middleware('auth');
Route::get('/user/{user}/reserves/{reserve}', 'ReservesController@show');
Route::post('/user/{user}/reserves/create', 'ReservesController@store')->middleware('auth');

//Rutas de votos
Route::get('/user/{user}/votes/create', 'VotesController@create')->middleware('auth');
Route::get('/user/{user}/votes/{vote}', 'VotesController@show');
Route::post('/user/{user}/votes/create', 'VotesController@store')->middleware('auth');

//Rutas de facturas
Route::get('/user/{user}/invoices/create', 'InvoicesController@create')->middleware('auth');
Route::get('/user/{user}/invoices/{invoice}', 'InvoicesController@show');
Route::post('/user/{user}/invoices/create', 'InvoicesController@store')->middleware('auth');

//Rutas de lugares
Route::get('/user/{user}/places/create', 'PlacesController@create')->middleware('auth');
Route::get('/user/{user}/places/{place}', 'PlacesController@show');
Route::post('/user/{user}/places/create', 'PlacesController@store')->middleware('auth');

//Rutas de comentarios
Route::get('/user/{user}/commentarys/create', 'CommentarysController@create')->middleware('auth');
Route::get('/user/{user}/commentarys/{commentary}', 'CommentarysController@showUser');
Route::post('/user/{user}/commentarys/create', 'CommentarysController@store')->middleware('auth');
Route::get('/events/{event}/commentarys/{commentary}', 'EventsController@showEvent');

Route::get('/profile', 'UsersController@profile')->middleware('auth');
Route::get('/user/{user}', 'UsersController@index')->name('user.username');

Auth::routes();