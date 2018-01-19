<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function game(){
        return $this->belongsTo('App\Game','game','game');
    }
}
