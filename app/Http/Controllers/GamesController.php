<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator; 

class GamesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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
        $validatedData = $request->validate([
            'date' => 'date|before:"2018-03-05"|after:"2018-03-01"',
            'score_nthu' => 'nullable|numeric',
            'score_nctu' => 'nullable|numeric',
            'score_draw' => 'nullable|numeric',
            'boardcast_url' => 'nullable|url',
            'location_url' => 'url',
        ]);
        $game->update($request->all());
        return redirect()->route('games.index')->with('success','更新賽事資料成功');
    }
}
