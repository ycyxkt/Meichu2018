<?php

namespace App\Http\Controllers;

use Cache;

use Illuminate\Http\Request;

use App\Game;
use App\Repositories\GameRepository;

use App\News;
use App\Repositories\NewsRepository;

class HomeController extends Controller
{

    /**
     * Construct
     */
    public function __construct()
    {
        $this->gameRepository = new GameRepository(new Game);
        $this->newsRepository = new NewsRepository(new News);
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

    /**
     * 首頁的主畫面
     */
    public function home()
    {

        /**
         * 取得所有賽程
         */
        $games = Cache::remember('GAME:SCHEDULE', 5, function() {
            return $this->gameRepository->getGameSchedule();
        });

        /**
         * 取得 準備中 & 進行中 的比賽
         */
        $games_top = Cache::remember('GAME:TRENDING', 3, function() {
            return $this->gameRepository->getTrending();
        });

        /**
         * 取得所有新聞
         */
        $news = Cache::remember('NEWS:NEWS', 10, function() {
            return $this->newsRepository->getNews();
        });

        return view('home', compact('games', 'games_top', 'news'));
    }

    /**
     * 進來到首頁前的「預首頁」
     *
     * 從快取中取得資料，如果快取中沒有，就查詢後放到快取中，時間 5 分鐘
     */
    public function prehome()
    {

        $games = Cache::remember('GAME:SCHEDULE', 5, function() {
            return $this->gameRepository->getGameSchedule();
        });

        return view('prehome', compact('games'));

    }
}
