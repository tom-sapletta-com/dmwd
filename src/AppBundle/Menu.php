<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2017-08-10
 * Time: 20:22
 */

namespace AppBundle;


class Menu
{
    public $videos = [];

    /**
     * @return array
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param array $videos
     */
    public function setVideo(array $videos)
    {
        foreach ($videos as $video) {
            $this->videos[] = new Video($video);
        }
    }
}