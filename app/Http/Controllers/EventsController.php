<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;

class EventsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->group == 'committee'){
            $query = \App\Event::join('users', 'users.id', '=', 'events.user_id')
                    ->where('group', '=', Auth::user()->group)
                    ->select('users.name','events.*');
        }
        if(Auth::user()->group == 'admin'){
            $query = \App\Event::where('id','>','0');
        }
        else {
            $query = \App\Event::where('user_id', '=', Auth::user()->id);
        }
        $events = $query->orderBy('id','asc')
                ->get();
        $ticket_nthu = \App\Text::where('name','=','ticket_nthu')->get();
        $text_nthu = $ticket_nthu->first()->content;
        $ticket_nctu = \App\Text::where('name','=','ticket_nctu')->get();
        $text_nctu = $ticket_nctu->first()->content;
        $data = compact('events','text_nthu','text_nctu');
        return view('m.events.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('m.events.create');
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
            'date' => 'date|before:"2018-03-31"|after:'.date('Y-m-d',strtotime(date('Y-m-d') . '-1 days')),
            'link' => 'nullable|url',
        ]);
        \App\Event::create($request->all());
        return redirect()->route('events.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = \App\Event::find($id);
        if (Gate::denies('edit-events', $event)) {
            return redirect()->route('events.index');
        }
        $data = compact('event');

        return view('m.events.edit', $data);
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
        $event = \App\Event::findOrFail($id);
        if (Gate::denies('edit-events', $event)) {
            return redirect()->route('events.index');
        }
        $validatedData = $request->validate([
            'date' => 'date|before:"2018-03-31"|after:"2018-01-01"',
            'link' => 'nullable|url',
        ]);
        $event->update($request->all());
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events = \App\Event::findOrFail($id);
        if (Gate::allows('edit-events', $events)) {
            $events->delete();
        }
        return redirect()->route('events.index');
    }
}
