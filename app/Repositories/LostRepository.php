<?php
namespace App\Repositories;

use DB;
use Carbon\Carbon;

class LostRepository
{
    /**
     * 遺失物 model 的 instance
     *
     * @var Game
     */
    protected $lost;

    /**
     * Construct
     *
     * @param \App\Lost $lost
     */
    public function __construct($lost)
    {
        $this->lost = $lost;
    }

    /**
     * 取得所有
     *
     * @return void
     */
    public function getLosts()
    {
        return $this->lost->orderBy('date','asc')->simplePaginate(20);
    }


}