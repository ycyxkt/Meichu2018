<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('committee');
    }

    public function index(){
        $games = \App\Game::orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();
        $data = compact('games');
        return view('m.games.index', $data);
    }
    public function edit($id){
        $game = \App\Game::findOrFail($id);
        $data = compact('game');
        return view('m.games.edit', $data);
    }
    public function update($id, Request $request){
        $game = \App\Game::findOrFail($id);
        $game->update($request->all());
        return redirect()->route('games.index');
    }
}
