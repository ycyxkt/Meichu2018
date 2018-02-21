<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    protected $guarded = ['id'];
    public function game(){
        return $this->belongsTo('App\Game','game_id','id');
    }
}
