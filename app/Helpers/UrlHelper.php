<?php
namespace App\Helpers;

class UrlHelper
{

    /**
     * Youtube 崁入播放器的格式
     *
     * @var string
     */
    protected static $youtubeEmbedFormat = 'https://www.youtube.com/embed/%s?rel=0&showinfo=0';

    /**
     * 取得 Youtube 崁入播放器的網址格式
     *
     * @param string $url
     * @return string|bool
     */
    public static function getYoutubeEmbed($url)
    {

        if ( $hash = static::getYoutubeHash($url) ) {
            return vsprintf(static::$youtubeEmbedFormat, $hash);
        }

        return false;

    }


    /**
     * 取得 Youtube 一般格式，或崁入播放器的 hash
     *
     * @param string $url
     * @return string|bool
     */
    public static function getYoutubeHash($url)
    {
        preg_match('/https?:\/\/www.youtube.com\/(embed\/|watch\?v=)(\w+)\?*.*/i', $url, $match);

        return $match[2] ?? false;

    }
}
