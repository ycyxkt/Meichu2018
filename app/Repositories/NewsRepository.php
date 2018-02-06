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
        return $this->news->where('tag', '!=', 'news')->findOrFail($id);
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
            ->where('tag', '!=', 'news')
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
            ->where('tag', '!=', 'news')
            ->orderBy('id','asc')
            ->first();
    }



}
