<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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
    public function prehome()
    {
        $games = \App\Game::select([
                'name', 'game', 'date', 'time', 'location',
        ])->whereIn('date', [
                '2018/03/02', '2018/03/03', '2018/03/04'
        ])
        ->orderBy('date','asc')
        ->orderBy('time','asc')->get()->groupBy('date');

        $gamestmp = \App\Game::where('game','=','bridge')
                ->get()->first();
        $gamestmp['date']='2018/03/04';
        $games['2018-03-04']->prepend($gamestmp);

        $data = compact('games');
        return view('prehome',$data);
    }
}
