<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2017-08-10
 * Time: 20:22
 */

namespace AppBundle\Xml;

/**
 * Class Videos
 * @package AppBundle\Xml
 */
class Videos
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
        /** @var array $video */
        foreach ($videos as $video) {
            if (is_array($video)) {
                $this->videos[$video['id']] = new \AppBundle\Xml\Video($video);
            }
        }
    }
}