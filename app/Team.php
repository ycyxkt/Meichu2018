<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    public function game(){
        return $this->belongsTo('App\Game','game','game');
    }
}
