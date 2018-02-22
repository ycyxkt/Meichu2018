<?php
namespace App\Repositories;

use App\News;

class NewsRepository
{

    /**
     * Construct
     *
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * 取得所有的新聞
     *
     * @return Collection
     */
    public function getLatestNews()
    {
        return $this->news->orderBy('is_sticky', 'desc')
                ->orderBy('id', 'desc')->take(6)->get();
    }

    /**
     * 取得所有
     *
     * @return void
     */
    public function getNews()
    {
        return $this->news->orderBy('is_sticky', 'desc')
                ->orderBy('id', 'desc')->simplePaginate(20);
    }

    /**
     * 依照給定的ID 取得新聞
     *
     * @param int $id
     * @return array
     */
    public function getNewsById($id)
    {
        return $this->news->where('tag', '!=', 'news')->where('tag', '!=', 'link')->findOrFail($id);
    }

    /**
     * 取得給定的ID 的上一篇新聞
     *
     * @param int $id
     * @return array
     */
    public function getPrevious($id)
    {
        return $this->news->select(['id', 'title'])->where('id', '<', $id)
            ->where('tag', '!=', 'news')->where('tag', '!=', 'link')
            ->orderBy('id','desc')
            ->first();
    }

    /**
     * 取得給定的ID 的下一篇新聞
     *
     * @param int $id
     * @return array
     */
    public function getNext($id)
    {
        return $this->news->select(['id', 'title'])->where('id', '>', $id)
            ->where('tag', '!=', 'news')->where('tag', '!=', 'link')
            ->orderBy('id','asc')
            ->first();
    }

    /**
     * 依照給予的賽程名稱，取得該賽程新聞
     *
     * @param string $gamename
     * @return void
     */
    public function getGameNews($gamename)
    {
        return $this->news->where('game','=',$gamename)
                ->orderBy('is_sticky', 'desc')->orderBy('id', 'desc')->get();
    }

}
