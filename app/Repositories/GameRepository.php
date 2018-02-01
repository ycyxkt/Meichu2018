<?php
namespace App\Repositories;

use Carbon\Carbon;
use App\Game;

class GameRepository
{
    /**
     * 比賽 model 的 instance
     *
     * @var Game
     */
    protected $game;

    /**
     * 比賽的總天數
     *
     * @var array
     */
    protected static $gameDates = [
        '2018/03/02', '2018/03/03', '2018/03/04'
    ];

    /**
     * 重覆天數的賽程
     *
     * @var array
     */
    protected static $lastingGames = [
        // 節目名稱 => 「重覆」的天數 (比原本的多幾天)
        'bridge' => 1,
    ];

    /**
     * Construct
     *
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }


    /**
     * 取得所有賽程表，如果有重覆的賽程，就加上重覆的天數
     *
     * @return Collection
     */
    public function getGameSchedule()
    {
        $games = $this->game->select([
            'name', 'game', 'date', 'time', 'location',
        ])->whereIn('date', static::$gameDates)
        ->orderBy('date','asc')->orderBy('time','asc')
        ->get();

        foreach(static::$lastingGames as $lastingGame => $lastingDate)
        {
            $cloned = clone $games->where('game', $lastingGame)->first();

            $cloned->date = Carbon::createFromFormat('Y-m-d', $cloned->date)
                ->addDays($lastingDate)->format('Y-m-d');

            $games->push($cloned);
        }

        return $games->sortBy('date')->sortBy('time')->groupBy('date');

    }

    /**
     * 取得正在進行中的賽稱
     *
     * @return Collection
     */
    public function getInProgress()
    {
        return $this->game->whereIn('status', ['prepare', 'inprogress'])
            ->orderBy('status','asc')
            ->orderBy('date','asc')
            ->orderBy('time','asc')
            ->get();
    }

}