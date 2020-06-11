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
    public function scheduleIndex(Trainer $trainer)
    {
        return view('trainers.schedules.index')->with(compact('trainer'));
    }

    public function scheduleShow(Schedule $schedule)
    {
        $trainerList = Trainer::get();
        return view('trainers.schedules.show')->with(compact('schedule', 'trainerList'));
    }

    public function scheduleEdit(Schedule $schedule)
    {
        $trainerList = Trainer::get();
        return view('trainers.schedules.edit')->with(compact('schedule', 'trainerList'));
    }

    public function scheduleUpdate(Request $request, Schedule $schedule)
    {
        $validatedData = $request->validate([
            'trainers' => 'required|array',
        ]);
        $schedule->trainers()->detach();
        $pivots = [];
        foreach($validatedData['trainers'] as $trainer) {
            $pivots[$trainer['trainer_id']] = ['role' => $trainer['role']];
        }
        $schedule->trainers()->sync($pivots);

        return response(['status' => 'success']);
    }

    public function scheduleCreate(Request $request, Trainer $trainer)
    {
        $trainers = json_encode([$trainer]);
        return view('trainers.schedules.create')->with(compact('trainers'));

    }

    public function eventIndex(Trainer $trainer)
    {
        dd($trainer);
       return view('trainers.events.index')->with(compact('trainer'));
    }
}
