<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donors = Donor::paginate();
        return view('donors.index', compact('donors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donors.create');
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
            'title' => 'required|unique:donors|max:127',
            'short_desc' => 'required',
            'full_desc' => '',
            'country' => 'required|max:255',
        ]);

        $donor = new Donor;
        $donor->title = $validatedData['title'];
        $donor->short_desc = $validatedData['short_desc'];
        if(isset($validatedData['full_desc'])) {
            $donor->full_desc = $validatedData['full_desc'];
        }
        $donor->country = $validatedData['country'];
        $donor->save();
        return redirect("/donor")->with('success', 'Donor Created');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Donor $donor)
    {
        return view('donors.show', compact('donor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id dd($donor);
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect("/donor")->with('success', 'Donor Deleted');
    }
    /**
     * 
     */
    public function projectsIndex(Donor $donor)
    {
        return view('donors.projects.index', compact('donor'));
    }
}
