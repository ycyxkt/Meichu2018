<?php
namespace App\Repositories;

use DB;
use Carbon\Carbon;
use App\Record;

class RecordRepository
{

    /**
     * Construct
     *
     * @param Record $record
     */
    public function __construct(Record $record)
    {
        $this->record = $record;
    }

    /**
     * 依照給予的紀錄$id，取得該紀錄
     *
     * @return Record
     */
    public function getRecordById($id)
    {
        return $this->record->findOrFail($id);
    }


    /**
     * 依照給予的$game_id，取得該賽事之所有紀錄
     *
     * @return Collection
     */
    public function getRecordByGameId($game_id)
    {
        return $this->record->where('game_id', $game_id)
            ->orderBy('order','asc')->orderBy('created_at','asc')
            ->get();
    }


}