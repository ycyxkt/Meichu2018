<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GameEditRequest;

use Cache;
use Imgur;
use Carbon\Carbon;
use Illuminate\Http\File;
use \Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use App\Game;
use App\Helpers\UrlHelper;
use App\Repositories\GameRepository;

use App\News;
use App\Repositories\NewsRepository;

class GamesController extends Controller
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
     * 後台的管理首頁，顯示所有賽程
     *
     * @return view
     */
    public function index()
    {
        $games = $this->gameRepository->getGames();

        $data = compact('games');
        return view('m.games.index', $data);
    }


    /**
     * 顯示編輯的頁面
     *
     * @param int $id
     * @return view
     */
    public function edit($id)
    {
        $game = $this->gameRepository->getGameById($id);

        $data = compact('game');
        return view('m.games.edit', $data);
    }

    /**
     * 編輯賽事資訊的頁面
     *
     * @param int $id
     * @param GameEditRequest $request
     * @return view
     */
    public function update($id, GameEditRequest $request)
    {
        if ( ! $game = $this->gameRepository->getGameById($id) ) {
            abort(404);
        }

        if ($request->hasFile('file_photo')) {
            $image = Imgur::upload($request->file('file_photo'));
            $request['photo'] = $image->link();
            $request['photosmall'] = Imgur::size($image->link(), 'l');
        }

        /**
         * 如果有直播網址，檢查是否為 Youtube 格式
         */
        if ($request['broadcast_url']) {

            if ( ! $broadcast_url = UrlHelper::getYoutubeEmbed($request['broadcast_url']) )  {
                return back()->withErrors(['broadcast_url'=> '必須是 Youtube 格式的網址'])->withInput();
            }

            $request['broadcast_url'] = $broadcast_url;
        }
        if ($request['vr360_url']) {

            if ( ! $vr360_url = UrlHelper::getYoutubeEmbed($request['vr360_url']) )  {
                return back()->withErrors(['vr360_url'=> '必須是 Youtube 格式的網址'])->withInput();
            }

            $request['vr360_url'] = $vr360_url;
        }

        $game->update($request->except('file_photo'));

        /**
         * 如果內容有更新，刪除快取，強迫重新取得新內容
         */
        Cache::forget("GAME:{$game->game}");
        Cache::forget("GAME:SCHEDULE");
        Cache::forget("GAME:INPROGRESS");
        Cache::forget("GAME:PREPARE");
        Cache::forget("GAME:TRENDING");
        Cache::forget("GAME:SCORE");

        return redirect()->route('games.index')->with('success','更新賽事資料成功');
    }

    /**
     * 前台的賽事列表、計分板等
     *
     * @return view
     */
    public function index_front()
    {

        /**
         * 取得所有比賽列表
         */
        $games = Cache::remember('GAME:SCHEDULE', 5, function() {
            return $this->gameRepository->getGameSchedule();
        });

        /**
         * 取得正在進行中的賽程
         */
        $games_inprogress = Cache::remember('GAME:INPROGRESS', 3, function() {
            return $this->gameRepository->getInProgress();
        });

        /**
         * 取得準備中的賽程
         */
        $games_prepare = Cache::remember('GAME:PREPARE', 3, function() {
            return $this->gameRepository->getPrepare();
        });

        /**
         * 取得清交比分
         */
        $score = Cache::remember('GAME:SCORE', 10, function () {
            return $this->gameRepository->getScore();
        });

        /**
         * 分數計算
         */
        $score_draw = ($score['draw'] ?? 0);
        $score_nthu = ($score['nthuwin'] ?? 0) + ($score_draw * .5);
        $score_nctu = ($score['nctuwin'] ?? 0) + ($score_draw * .5);

        /**
         * 計分板的狀態
         */
        $status = (function () use ($score_nctu, $score_nthu, $score_draw) {

            $now = Carbon::now();

            /** 開始與結束時間 */
            $startDate = Carbon::create(2018, 03, 02, 12, 00);
            $endDate = Carbon::create(2018, 03, 04, 23, 00);

            switch (true) {

                case ( $startDate->isFuture() ):
                    return "尚未開始";
                    break;

                case ( $now->between($startDate, $endDate) ):
                    return "進行中";
                    break;

                case $score_nctu > $score_nthu:
                    return "交大勝";
                    break;

                case $score_nthu > $score_nctu:
                    return "清大勝";
                    break;

                case $score_nthu == $score_nctu:
                    return "平手";
                    break;
            }

        })();

        $data = compact('status', 'games', 'games_inprogress','games_prepare','score_nthu','score_nctu','score_draw');
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

        $game = Cache::remember("GAME:{$gamename}", 5, function() use ($gamename) {

            if ( !$game = $this->gameRepository->getGame($gamename) ) {
                abort(404);
            }

            return $game;

        });
        $gamenews = $this->newsRepository->getGameNews($gamename);

        return view('games.show', compact('game','gamenews') );
    }
}
