<?php
namespace App\Repositories;

use Carbon\Carbon;

class LostRepository
{
    /**
     * 遺失物 model 的 instance
     *
     * @var Lost
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

    /**
     * 取得單項遺失物
     *
     * @param int $id
     * @return Lost
     */
    public function getLost($id)
    {
        return $this->lost->find($id);
    }

    /**
     * Undocumented function
     *
     * @param int $id
     * @return Lost
     */
    public function getLostWithTrashed($id)
    {
        return $this->lost->withTrashed()->find($id);
    }


}