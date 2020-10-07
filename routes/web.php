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

Route::get('/home', 'EventController@index')->name('home');

Route::post('/ckedit/upload', 'CkeditorController@upload')->name('ckeditor.upload');

Route::get('/event/list', 'EventController@list')->name('event.list');
Route::resource('event', 'EventController');

Route::get('/trainer/schedule', 'TrainerController@scheduleIndex')->name('trainer.schedule.index');
Route::get('/trainer/schedule/{schedule}', 'TrainerController@scheduleShow')->name('trainer.schedule.show');
Route::get('/trainer/schedule/{schedule}/edit', 'TrainerController@scheduleEdit')->name('trainer.schedule.edit');
Route::get('/trainer/{trainer}/schedule/create', 'TrainerController@scheduleCreate')->name('trainer.schedule.create');

Route::put('/trainer/schedule/{schedule}',  'TrainerController@scheduleUpdate')->name('trainer.schedule.update');

Route::get('/trainer/{trainer}/schedule',  'TrainerController@scheduleIndex')->name('trainer.schedule.index');

Route::resource('trainer', 'TrainerController');

Route::get('/schedule/event/{event}', 'ScheduleController@eventIndex')->name('schedule.event.index');
Route::get('/schedule/event/{event}/create', 'ScheduleController@eventCreate')->name('schedule.event.create');
Route::get('/schedule/{schedule}/trainer', 'ScheduleController@trainerIndex')->name('schedule.triner.index');
Route::delete('/schedule/{schedule}/trainer', 'ScheduleController@trainerDelete')->name('schedule.triner.delete');
Route::get('/schedule/{schedule}/trainer/create', 'ScheduleController@trainerCreate')->name('schedule.triner.create');
Route::resource('schedule', 'ScheduleController');

Route::resource('donor', 'DonorController');
Route::get('donor/{donor}/projects', 'DonorController@projectsIndex')->name('donor.projects.index');
Route::resource('project', 'ProjectController');

Route::resource('address', 'AddressController');
Route::resource('company', 'CompanyController');

