<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Schedule;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = DB::table('trainers')->paginate();
        //dd($trainers);
        return view('trainers.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainers.create');
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
            'name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'last_name' => '',
            'position' => '',
            'email' => 'required|email',
        ]);
        $trainer = new Trainer();
        $trainer->name = $validatedData['name'];
        $trainer->second_name = $validatedData['second_name'];
        $trainer->last_name = $validatedData['last_name'];
        $trainer->position = $validatedData['position'];
        $trainer->email = $validatedData['email'];
        $trainer->save();
        return redirect("/trainer")->with('success', 'Trainer Updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    //public function show($id)
    {
        //dd($trainer->schedules);
        //$trainer = Trainer::with('schedules')->where('id', '=', $id)->with('schedules.event')->first();
        //dd($trainer);
        return view('trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        //$trainer = Trainer::with('schedules')->where('id', '=', $id)->with('schedule.event')->first();
        //dd(json_encode($trainer->attributesToArray()));
        return view('trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'last_name' => '',
            'description' => 'max:1024',
            'position' => '',
            'email' => 'required|max:255',
        ]);
        $trainer->name = $validatedData['name'];
        $trainer->second_name = $validatedData['second_name'];
        $trainer->last_name = $validatedData['last_name'];
        $trainer->position = $validatedData['position'];
        $trainer->description = $validatedData['description'];
        $trainer->email = $validatedData['email'];
        $trainer->update();
        return redirect("/trainer")->with('success', 'Trainer Updated');
    }

    /**
     * @param Trainer $trainer
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Trainer $trainer)
    {
        $trainer->delete();
        return redirect("/trainer")->with('success', 'Trainer Deleted');
    }
    public function scheduleIndex(Trainer $trainer, $Scedil)
    {
        //$trainer = Trainer::with('schedule')->where('id', '=', $id)->first();
        return view('trainers.schedules.index')->with(compact('trainer'));
    }

    public function scheduleShow(Schedule $schedule)
    {
        return view('trainers.schedules.show')->with(compact('schedule'));
    }

    public function scheduleEdit(Schedule $schedule)
    {
        return view('trainers.schedules.edit')->with(compact('schedule'));
    }

    /**
     * @param Request $request
     * @param Trainer $trainer
     */
    public function createSchedule(Request $request, Trainer $trainer)
    {
        return view('trainers.schedule.create')->with(compact('trainer'));

    }

    /**
     * @param Request $request
     * @param Trainer $trainer
     */
    public function updateSchedule(Request $request, Trainer $trainer)
    {
        return view('trainers.schedule')->with(compact('trainer'));

    }

    public function eventIndex(Trainer $trainer)
    {
        dd($trainer);
       return view('trainers.events.index')->with(compact('trainer'));
    }
}
