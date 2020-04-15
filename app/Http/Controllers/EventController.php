<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Event;

class EventController extends Controller
{
    private const ROW = '`id`, `title`, `short_desc`, `full_desc`, binary_2_binstr(`duration`) duration';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = DB::table('events')->select(DB::raw(self::ROW))->paginate(10);
        return view('events.index', compact('events'));
    }
    
    /**
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        //dd($id);
        //$event =  Event::findOrFail($id);
        
        $data = request()->validate([
            'title' => 'required',
            'short_desc' => '',
            'full_desc' => '',
//            'image' => ['required', 'image'],
        ]);
        
        return view('events.create');
    }
    public function store() {
        dd(request()->all());
    }
    
    public function show($id) {
        $event = DB::table('events')
            ->where('id', '=', $id)
            ->select(DB::raw(self::ROW))
            ->first();
        
        $event->duration = str_split($event->duration, 24);
        
        return view('events.show', compact('event'));
    }

    public function edit($id) {
        $event = DB::table('events')
            ->where('id', '=', $id)
            ->select(DB::raw(self::ROW))
            ->first();
        
        $event->duration = str_split($event->duration, 24);
        
        return view('events.edit', compact('event'));
    }
    
    public function update(Event $event)
    {
        print_r($event);
        sleep(10);
        return redirect("/event");
    }
}
