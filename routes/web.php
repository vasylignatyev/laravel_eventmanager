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
Route::get('/event/list', 'EventController@list')->name('event.list');
Route::get('/event/{event}', 'EventController@show')->name('event.show');
Route::patch('/event/{event}', 'EventController@update')->name('event.update');
Route::get('/event/{event}/edit', 'EventController@edit')->name('event.edit');
Route::delete('/event/{event}', 'EventController@destroy')->name('event.destroy');
Route::post('/event', 'EventController@store')->name('event.store');

Route::get('/trainer/schedule',  'TrainerController@scheduleIndex')->name('trainer.schedule.index');
Route::get('/trainer/schedule/{schedule}',  'TrainerController@scheduleShow')->name('trainer.schedule.show');
Route::get('/trainer/schedule/{schedule}/edit',  'TrainerController@scheduleEdit')->name('trainer.schedule.edit');
Route::get('/trainer/{trainer}/schedule',  'TrainerController@scheduleIndex')->name('trainer.schedule.index');
Route::get('/trainer/{trainer}/create', 'TrainerController@createSchedule')->name('trainer.createSchedule');
Route::patch('/trainer/{trainer}/update', 'TrainerController@updateSchedule')->name('trainer.updateSchedule');
Route::resource('trainer', 'TrainerController');

Route::get('/schedule/event/{event}', 'ScheduleController@eventIndex')->name('schedule.event.index');
Route::get('/schedule/event/{event}/create', 'ScheduleController@eventCreate')->name('schedule.event.create');
Route::resource('schedule', 'ScheduleController');
