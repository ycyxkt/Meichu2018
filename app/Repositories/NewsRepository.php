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
    public function getNews()
    {
        return $this->news->orderBy('id', 'desc')->take(6)->get();
    }

}
