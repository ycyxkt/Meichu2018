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

}