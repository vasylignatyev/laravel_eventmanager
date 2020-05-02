<?php

namespace App\Http\Controllers;

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
    public function show($id)
    {
        //$trainer = Trainer::with('schedule')->where('id', '=', $id)->first();
        $trainer = Trainer::with('schedule')->where('id', '=', $id)->with('schedule.event')->first();
        //$trainer = $trainer->schedule->first()->event;
        //dd($trainer->schedule);
        return view('trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainer = Trainer::with('schedule')->where('id', '=', $id)->with('schedule.event')->first();
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
            'position' => '',
            'email' => 'required|max:255',
        ]);
        $trainer->name = $validatedData['name'];
        $trainer->second_name = $validatedData['second_name'];
        $trainer->last_name = $validatedData['last_name'];
        $trainer->position = $validatedData['position'];
        $trainer->email = $validatedData['email'];
        $trainer->save();
        return redirect("/trainer")->with('success', 'Trainer Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
