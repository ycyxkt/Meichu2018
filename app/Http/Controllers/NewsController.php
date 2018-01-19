<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;

class NewsController extends Controller
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
            $query = \App\News::join('users', 'users.id', '=', 'news.user_id')
                    ->where('group', '=', Auth::user()->group)
                    ->select('users.name','news.*');
        }
        if(Auth::user()->group == 'admin'){
            $query = \App\News::withTrashed();
        }
        else {
            $query = \App\News::where('user_id', '=', Auth::user()->id);
        }
        $news = $query->orderBy('id','asc')
                ->get();
        $data = compact('news');
        return view('m.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('games');
        return view('m.news.create', $data);
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
            'link' => 'nullable|url',
            'content' => 'nullable|string|max:600',
        ]);
        $request['user_id']=Auth::user()->id;
        \App\News::create($request->all());
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->group == 'admin'){
            $news = \App\News::withTrashed()
                    ->find($id);
        }
        else{
            $news = \App\News::find($id);
        }
        if (Gate::denies('edit-news', $news)) {
            return redirect()->route('news.index');
        }
        $data = compact('news');

        return view('m.news.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = \App\News::find($id);
        if (Gate::denies('edit-news', $news)) {
            return redirect()->route('news.index');
        }
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->select('name','game')
                ->get();
        $data = compact('news','games');

        return view('m.news.edit', $data);
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
        $news = \App\News::findOrFail($id);
        if (Gate::denies('edit-news', $news)) {
            return redirect()->route('news.index');
        }
        $validatedData = $request->validate([
            'link' => 'nullable|url',
            'content' => 'nullable|string|max:600',
        ]);
        $news->update($request->all());
        return redirect()->route('news.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = \App\News::findOrFail($id);
        if (Gate::allows('edit-news', $news)) {
            $news->delete();
        }
        return redirect()->route('news.index');
    }
}
