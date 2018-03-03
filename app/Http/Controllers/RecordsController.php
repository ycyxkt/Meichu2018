<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;

use App\Record;
use App\Repositories\RecordRepository;
use App\Game;
use App\Repositories\GameRepository;

class RecordsController extends Controller
{
    /**
     * Construct
     */
    public function __construct(){
        $this->middleware('committee');
        $this->recordRepository = new RecordRepository(new Record);
        $this->gameRepository = new GameRepository(new Game);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($game_id)
    {
        $game = $this->gameRepository->getGameById($game_id);
        if ( 'notgame' == $game->type){
            abort(404);
        }
        return view('m.records.create', compact('game'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['be_last'] || $request['order'] == NULL){
            if($record = $this->recordRepository->getRecordsByGameId($request['game_id'])->last()){
                $request['order'] = $record->order + 1;
            }
            else{
                $request['order'] = 1;
            }
        }
        Record::create($request->except('be_last'));
        Cache::forget("GAME:RECORD:{$request->game_id}");
        return redirect()->route('games.records',$request['game_id'])->with('success','建立紀錄成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = $this->recordRepository->getRecordById($id);

        return view('m.records.edit', compact('record'));
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
        if ( ! $record = $this->recordRepository->getRecordById($id) ){
            abort(404);
        }
        $record->update($request->all());
        Cache::forget("GAME:RECORD:{$request->game_id}");
        return redirect()->route('games.records',$record['game_id'])->with('success','更新紀錄資訊成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( ! $record = $this->recordRepository->getRecordById($id) ){
            abort(404);
        }
        Cache::forget("GAME:RECORD:{$record->game_id}");
        $record->delete();
        return redirect()->route('games.records',$record['game_id'])->with('success','刪除紀錄成功');
    }

    public function ShowbyGameId($game_id)
    {
        $game = $this->gameRepository->getGameById($game_id);
        if ( 'notgame' == $game->type){
            abort(404);
        }
        $records = $this->recordRepository->getRecordsByGameId($game_id);
        
        return view('m.records.game', compact('records','game'));
    }
}
