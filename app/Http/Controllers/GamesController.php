<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use Imgur;
use Illuminate\Http\File;
use \Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use App\Game;
use App\Repositories\GameRepository;

class GamesController extends Controller
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->gameRepository = new GameRepository(new Game);
    }

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
            'broadcast_url' => 'nullable|url',
            'location_url' => 'url',
            'file_photo' => 'image|mimes:jpeg,png,jpg|max:5000',
        ]);
        if($request->hasFile('file_photo')){
                $image = Imgur::upload($request->file('file_photo'));
                $request['photo'] = $image->link();
                $request['photosmall'] = Imgur::size($image->link(), 'l');
        }
        $tmp = explode('/watch?v=',$request['broadcast_url']);
        if(!isset($tmp[1])){
                $tmp = explode('youtu.be/',$request['broadcast_url']);
        }
        $request['broadcast_url'] = "https://www.youtube.com/embed/".$tmp[1]."?rel=0&amp;showinfo=0";
        $game->update($request->except('file_photo'));
        return redirect()->route('games.index')->with('success','更新賽事資料成功');
    }

    public function index_front(){
        $games_day1 = \App\Game::where('date','=','2018/03/02')
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();
        $games_day2 = \App\Game::where('date','=','2018/03/03')
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();

        $games_day3 = \App\Game::where('date','=','2018/03/04')
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();
        $gamestmp = \App\Game::where('game','=','bridge')
                ->get()->first();
        $gamestmp['date']='2018/03/04';
        $games_day3->prepend($gamestmp);
        $games_inprogress = \App\Game::where('status','=','inprogress')
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();
        $games_prepare = \App\Game::where('status','=','prepare')
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();
        $score_draw = \App\Game::where('status','=','draw')
                ->where('type','=','official')
                ->count();
        $score_nthu = \App\Game::where('status','=','nthuwin')
                ->where('type','=','official')
                ->count();
        $score_nctu = \App\Game::where('status','=','nctuwin')
                ->where('type','=','official')
                ->count();
        $score_nthu = $score_nthu +($score_draw / 2);
        $score_nctu = $score_nctu +($score_draw / 2);
        if(now() < '2018-03-02 12:00'){
                $status = '尚未開始';
        }
        elseif(now() > '2018-03-04 23:00'){
                if( $score_nctu > $score_nthu){
                        $status = '交大勝';
                }
                elseif( $score_nthu > $score_nctu){
                        $status = '清大勝';
                }
                else{
                        $status = '平手';
                }
        }
        else{
                $status = '進行中';
        }
        $data = compact('status','games_day1','games_day2','games_day3','games_inprogress','games_prepare','score_nthu','score_nctu','score_draw');
        return view('games.index', $data);
    }

    /**
     * 前端的賽程列表
     *
     * @param string $gamename
     * @return view
     */
    public function show_front($gamename)
    {

        if ( !$game = $this->gameRepository->getGame($gamename) ) {
            abort(404);
        }

        return view('games.show', compact('game') );
    }
}
