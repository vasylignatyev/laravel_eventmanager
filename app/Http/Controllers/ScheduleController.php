<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Schedule;
use App\Models\Trainer;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::with('event')->orderByDesc('start_date')->paginate();
        return view('schedules.index', compact('schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|integer',
            'start_date' => 'required',
            'trainers' => 'array',
            'trainers.*' => 'integer',
            'latitude' => '',
            'longitude' => '',
        ]);
        $event = Event::findOrFail($validatedData['event_id']);
        $schedule = $event->schedules()->create([
                'start_date' => $validatedData['start_date'],
        ]);

        if(isset($validatedData['trainers'])) {
            foreach($validatedData['trainers'] as $trainer) {
                $pivots[$trainer] = ['role' => null];
            }
            $schedule->trainers()->sync($pivots);
        }

        return redirect("/schedule")->with('success', 'Schedule Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|integer',
            'start_date' => 'required',
            'address' => '',
            //'latitude' => 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
            'latitude' => '',
            //'longitude' => 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/',
            'longitude' => '',
        ]);
        $schedule->update(
            $validatedData
/*            [
            'event_id' => $validatedData['event_id'],
            'start_date' => $validatedData['start_date'],
            'address' => $validatedData['address'],
            ]*/
        );
        return redirect("/schedule")->with('success', 'Schedule Created');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect('/schedule')->with('success', _('Schedule Deleted'));
    }

    public function eventIndex(Event $event) {
        $schedule = $event->schedules()->get();
        return view('schedules.index', compact('schedule', 'event'));
    }

    public function eventCreate(Event $event) {
        return view('schedules.create', compact('event'));
    }
}
