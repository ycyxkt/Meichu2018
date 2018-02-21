<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Auth;
use Gate;

use App\Event;
use App\Repositories\EventRepository;
use App\Game;
use App\Repositories\GameRepository;

class EventsController extends Controller
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->eventRepository = new EventRepository(new Event);
        $this->gameRepository = new GameRepository(new Game);
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
                    ->where('users.group', '=', 'committee')
                    ->select('events.*');
        }
        elseif(Auth::user()->group == 'admin'){
            $query = \App\Event::where('id','>','0');
        }
        else {
            $query = \App\Event::where('user_id', '=', Auth::user()->id);
        }
        $events = $query->orderBy('id','asc')
                ->get();

        $text_nthu = \App\Text::where('name','=','ticket_nthu')
                    ->get()->first()->content;
        $text_nctu = \App\Text::where('name','=','ticket_nctu')
                    ->get()->first()->content;

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
        $request['user_id']=Auth::user()->id;
        \App\Event::create($request->all());

        Cache::forget("EVENT:TICKETS");
        Cache::forget("EVENT:NCTU");
        Cache::forget("EVENT:NTHU");
        return redirect()->route('events.index')->with('success','建立活動成功');
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
            return redirect()->route('events.index')->with('error','您沒有權限編輯');
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
            return redirect()->route('events.index')->with('error','您沒有權限編輯');
        }
        $validatedData = $request->validate([
            'date' => 'date|before:"2018-03-31"|after:"2018-01-01"',
            'link' => 'nullable|url',
        ]);
        $event->update($request->all());

        Cache::forget("EVENT:TICKETS");
        Cache::forget("EVENT:NCTU");
        Cache::forget("EVENT:NTHU");
        return redirect()->route('events.index')->with('success','更新活動資訊成功');
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
            
            Cache::forget("EVENT:TICKETS");
            Cache::forget("EVENT:NCTU");
            Cache::forget("EVENT:NTHU");
            return redirect()->route('events.index')->with('success','刪除活動成功');
        }
        return redirect()->route('events.index')->with('error','您沒有權限刪除');
    }

    /**
     * 前端的「票務」網頁
     *
     * @return view
     */
    public function ticket_front()
    {
        $tickets = Cache::remember('EVENT:TICKETS', 10, function() {
            return $this->eventRepository->getAskForTickets();
        });

        $text = \App\Text::whereIn('name', array('ticket_nthu','ticket_nctu'))
                ->get()->groupBy('name');

        $games_is_ticket = $this->gameRepository->getRequiresTicket(1);

        $data = compact('tickets','text','games_is_ticket');
        return view('tickets', $data);
    }

    /**
     * 前端的「系列活動」網頁
     *
     * @return view
     */
    public function event_front()
    {
        $events_nthu = Cache::remember('EVENT:NTHU', 10, function() {
            return $this->eventRepository->getNTHUEvents();
        });
        $events_nctu = Cache::remember('EVENT:NCTU', 10, function() {
            return $this->eventRepository->getNCTUEvents();
        });

        return view('events', compact('events_nthu','events_nctu'));
    }
}
