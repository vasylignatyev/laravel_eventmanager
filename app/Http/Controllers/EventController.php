<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('events');
    }
    
    /**
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get($id)
    {
        dd($id);
        return view('events');
    }
}
