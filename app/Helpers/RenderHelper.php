<?php
namespace App\Helpers;

class RenderHelper
{
    /**
     * 按照換行字元，將文字切割成一個陣列
     *
     * @param string $text
     * @return array
     */
    public static function lineToArray($text = NULL)
    {

        if ( !$text ) {
            return [];
        }

        $text = explode("\r\n", $text);
        $text = array_filter($text, 'trim');

        return $text;
    }

}