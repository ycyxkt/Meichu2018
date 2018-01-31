<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Repositories\GameRepository;

class HomeController extends Controller
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->gameRepository = new GameRepository(new Game);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('about');
    }
    public function home()
    {
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
        $games_top = \App\Game::where(function ($query) {
                $query->where('status', '=', 'prepare')
                ->orWhere('status', '=', 'inprogress');})
                ->orderBy('status','asc')
                ->orderBy('date','asc')
                ->orderBy('time','asc')
                ->get();
        $news = \App\News::orderBy('id','desc')
                ->take(6)
                ->get();
        $data = compact('games_day1','games_day2','games_day3','games_top','news');
        return view('home',$data);
    }

    /**
     * 進來到首頁前的「預首頁」
     */
    public function prehome()
    {

        $games = $this->gameRepository->getGameSchedule();

        return view('prehome', compact('games'));

    }
}
