<?php
namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Event;

class EventRepository
{

    /**
     * Construct
     *
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }


    /**
     * 取得兩校的「索票活動」
     *
     * @return Collection
     */
    public function getAskForTickets()
    {
        return $this->event->whereIn('tag', [
            '清大索票活動','交大索票活動'
        ])->orderBy('date','asc')->orderBy('time','asc')
        ->get()->groupBy('tag');
    }

    /**
     * 取得清大相關活動
     *
     * @return Collection
     */
    public function getNTHUEvents()
    {
        return $this->event->whereIn('tag', [
            '清大賽前活動','兩校賽前活動','賽事相關活動'
        ])->orderBy('date','asc')->orderBy('time','asc')
                ->get();
    }

    /**
     * 取得交大相關活動
     *
     * @return Collection
     */
    public function getNCTUEvents()
    {
        return $this->event->whereIn('tag', [
            '交大賽前活動','兩校賽前活動','賽事相關活動'
        ])->orderBy('date','asc')->orderBy('time','asc')
                ->get();
    }

}