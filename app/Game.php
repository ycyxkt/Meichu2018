<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\RenderHelper;

class Game extends Model
{
    //
    protected $fillable = [
        'photo',
        'photosmall',
        'date',
        'time',
        'location',
        'location_url',
        'status',
        'score_nctu',
        'score_nthu',
        'score_draw',
        'info_entry',
        'info_rule',
        'is_ticket',
        'is_broadcast',
        'broadcast_url',
        'broadcast_org',
        'broadcast_anchor',
        'is_vr360',
        'vr360_url',
        'vr360_info',
    ];
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
     * {Accessor} 將 info_entry (入場須知) 切割成一個陣列
     */
    public function getInfoEntryListAttribute()
    {
        return RenderHelper::lineToArray($this->info_entry);
    }

}
