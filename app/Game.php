<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\RenderHelper;

class Game extends Model
{
    //
    protected $guarded = ['id'];
    public function teams(){
        return $this->hasMany('App\Team','game','game');
    }
    public function news(){
        return $this->hasMany('App\News','game','game');
    }

    /**
     * {Accessor} 取得該比賽交大的隊伍
     */
    public function getTeamNctuAttribute()
    {
        return $this->teams()->where('school', 'nctu')->first();
    }

    /**
     * {Accessor} 取得該比賽清大的隊伍
     */
    public function getTeamNthuAttribute()
    {
        return $this->teams()->where('school', 'nthu')->first();
    }

    /**
     * {Accessor} 取得該比賽歷史總場次
     */
    public function getHistoryAllAttribute()
    {
        return $this->history_nctu + $this->history_nthu + $this->history_draw;
    }

    /**
     * {Accessor} 取得該比賽交大勝率
     */
    public function getHistoryPrecentageNctuAttribute()
    {
        return round($this->history_nctu / $this->history_all * 100);
    }

    /**
     * {Accessor} 取得該比賽清大勝率
     */
    public function getHistoryPrecentageNthuAttribute()
    {
        return round($this->history_nthu / $this->history_all * 100);
    }

    /**
     * {Accessor} 取得該比賽平手機率
     */
    public function getHistoryPrecentageDrawAttribute()
    {
        return 100 - $this->history_precentage_nctu - $this->history_precentage_nthu;
    }

    /**
     * {Accessor} 將 info_entry (入場須知) 切割成一個陣列
     */
    public function getInfoEntryListAttribute()
    {
        return RenderHelper::lineToArray($this->info_entry);
    }

}
