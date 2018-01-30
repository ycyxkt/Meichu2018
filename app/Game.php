<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    ];
    public function teams(){
        return $this->hasMany('App\Team','game','game');
    }
    public function news(){
        return $this->hasMany('App\News','game','game');
    }
}
