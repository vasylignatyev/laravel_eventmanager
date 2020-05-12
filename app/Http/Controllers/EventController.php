<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Event;

class EventController extends Controller
{
    private const ROW = '`id`, `title`, `short_desc`, `full_desc`, `created_at`, binary_2_binstr(`duration`) duration';

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

    public function list()
    {
        $events = DB::table('events')->select(DB::raw(self::ROW))->get();
        //dd($events);
        return json_encode($events);
    }

    /**
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'short_desc' => 'required',
            'full_desc' => '',
            'duration' => 'array',
            'image' => '',
        ]);

        $event = new Event;
        $event->duration = isset($validatedData['duration']) ? $this->getDuration($validatedData['duration']) : '';
        $event->title = $validatedData['title'];
        $event->short_desc = $validatedData['short_desc'];
        if(isset($validatedData['full_desc'])) {
            $event->full_desc = $validatedData['full_desc'];
        }
        $event->save();
        return redirect("/event")->with('success', 'Event Created');
    }

    public function show($id)
    {
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

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'short_desc' => 'required',
            'full_desc' => '',
            'duration' => 'array',
            'image' => '',
        ]);
        $event->duration = isset($validatedData['duration']) ? $this->getDuration($validatedData['duration']) : '';
        $event->title = $validatedData['title'];
        $event->short_desc = $validatedData['short_desc'];
        $validatedData['full_desc'] && $event->full_desc = $validatedData['full_desc'];
        $event->save();
        return redirect("/event")->with('success', 'Event Updated');
    }
    /**
     * @param Event $event
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect("/event")->with('success', 'Event Deleted');
    }
    /**
     * @param array $durationArr
     * @return string
     */
    private function getDuration(array $durationArr)
    {
        $result = [];
        $durationLength = (intval(max($durationArr)/24) + 1) * 24;
        $result = array_fill(0, $durationLength, "0");
        foreach ($durationArr as $datum) {
            $result[intval($datum)] = "1";
        }
        return implode($result);
    }
}
