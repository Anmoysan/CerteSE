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

Route::get('/events/create', 'EventsController@create')->middleware('auth');
Route::get('/events/{event}', 'EventsController@show');
Route::post('/events/create', 'EventsController@store')->middleware('auth');

Route::get('/profile', 'UsersController@profile')->middleware('auth');
Route::get('/user/{user}', 'UsersController@index')->name('user.index');

Auth::routes();

/*Route::get('/', function () {
    return view('welcome');
});
*/
