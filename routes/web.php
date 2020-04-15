<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/event', 'EventController@index')->name('event.index');
Route::get('/event/create', 'EventController@create')->name('event.create');
Route::get('/event/{event}', 'EventController@show')->name('event.show');
Route::get('/event/{event}/edit', 'EventController@edit')->name('event.edit');
Route::patch('/event/{event}', 'EventController@delete')->name('event.update');
Route::delete('/event/{event}/delete', 'EventController@delete')->name('event.delete');
Route::post('/event', 'EventController@store')->name('event.store');
