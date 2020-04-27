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

        return view('events.show', compact('event'));
    }

    public function edit($id) {
        $event = DB::table('events')
            ->where('id', '=', $id)
            ->select(DB::raw(self::ROW))
            ->first();

        //$event->duration = str_split($event->duration, 24);

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            //'id' => 'integer',
            'title' => 'required|max:255',
            'short_desc' => 'required',
            'full_desc' => '',
            'duration' => 'array',
            'image' => '',
        ]);
        $durationArr = [];
        if( isset($validatedData['duration'])) {
            $durationLength = (intval(max($validatedData['duration'])/24) + 1) * 24;
            $durationArr = array_fill(0, $durationLength, "0");
            foreach ($validatedData['duration'] as $datum) {
                $durationArr[intval($datum)] = "1";
            }
        }
        $event->duration = implode($durationArr);
        $event->title = $validatedData['title'];
        $event->short_desc = $validatedData['short_desc'];
        if(isset($validatedData['full_desc'])) {
            $event->full_desc = $validatedData['full_desc'];
        }

        try {
            $event->save();
        } catch (\Exception $e) {
            dd($e);
        }
        dd($event);
        redirect("/");
    }
}
