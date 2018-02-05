<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\RenderHelper;

class Text extends Model
{
    //
    protected $guarded = ['id'];

    public function getContentListAttribute()
    {
        return RenderHelper::lineToArray($this->content);
    }
}
