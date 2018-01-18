<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $guarded = ['id'];
    public function game(){
        return $this->belongsTo('App\Game','game','game');
    }
}
