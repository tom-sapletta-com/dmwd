<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2017-08-10
 * Time: 20:22
 */

namespace AppBundle;

//        <id>3007</id>
//        <released>2017-04-03 11:04:55</released>
//        <duration>00:00:31</duration>
//        <title>Ed Sheeran: Wird es seine letzte Tour?</title>
//        <description>Der britische Megastar möchte, sobald er Kinder hat, nicht mehr auf Tour gehen und stattdessen mit
//            seiner Familie auf dem Dorf leben. Wird dies schon seine letzte Tour?
//        </description>
//        <date>2017-03-29</date>
//        <author>Bang Showbiz</author>
//        <picture>http://vod.gcdn.eu/3007/_picture.jpg</picture>
//        <video_240p>http://vod.gcdn.eu/3007/v240.mp4</video_240p>
//        <video_360p>http://vod.gcdn.eu/3007/v360.mp4</video_360p>
//        <video_480p>http://vod.gcdn.eu/3007/v480.mp4</video_480p>
//        <video_720p>http://vod.gcdn.eu/3007/v720.mp4</video_720p>
//        <keywords>
//            <keyword>Ed Sheeran</keyword>
//            <keyword>Richard Arnold</keyword>
//            <keyword>Cherry Seaborn</keyword>
//        </keywords>
//        <categories>
//            <category>DE-News</category>
//            <category>Lifestyle</category>
//        </categories>

class Video
{
    private $id;

    /** @var \DateTime */
    private $released;

    private $duration;
    private $title;
    private $description;

    private $date;
    private $author;
    private $picture;
    private $video_240p;
    private $video_360p;
    private $video_480p;
    private $video_720p;

    private $keywords = [];
    private $categories = [];

    /**
     * Video constructor.
     * @param array $child
     */
    public function __construct(array $child)
    {
        $this->fromArray($child);
    }


    /**
     * @param array $child
     */
    public function fromArray(array $child)
    {

        $this->id = $child['id'];
        $this->released = $child['released'];

        $this->duration = null;
        if (!empty($child['duration'])) {
            $this->setDurationFromString($child['duration']);
        }

        $this->title = $child['title'];
        $this->description = $child['description'];

        $this->setDate($child['date']);

        $this->author = $child['author'];
        $this->picture = $child['picture'];
        $this->video_240p = $child['video_240p'];
        $this->video_360p = $child['video_360p'];
        $this->video_480p = $child['video_480p'];
        $this->video_720p = $child['video_720p'];
        $this->setKeywords($child['keywords']);
        $this->setCategories($child['categories']);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param mixed $released
     */
    public function setReleased($released)
    {
        $this->released = $released;
    }

    /**
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param \DateTime $duration
     */
    public function setDuration(\DateTime $duration)
    {
        $this->duration = $duration;
    }

    /**
     * @param string $date
     */
    public function setDurationFromString($date)
    {
        $this->setDuration(new \DateTime($date));
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getVideo240p()
    {
        return $this->video_240p;
    }

    /**
     * @param mixed $video_240p
     */
    public function setVideo240p($video_240p)
    {
        $this->video_240p = $video_240p;
    }

    /**
     * @return mixed
     */
    public function getVideo360p()
    {
        return $this->video_360p;
    }

    /**
     * @param mixed $video_360p
     */
    public function setVideo360p($video_360p)
    {
        $this->video_360p = $video_360p;
    }

    /**
     * @return mixed
     */
    public function getVideo480p()
    {
        return $this->video_480p;
    }

    /**
     * @param mixed $video_480p
     */
    public function setVideo480p($video_480p)
    {
        $this->video_480p = $video_480p;
    }

    /**
     * @return mixed
     */
    public function getVideo720p()
    {
        return $this->video_720p;
    }

    /**
     * @param mixed $video_720p
     */
    public function setVideo720p($video_720p)
    {
        $this->video_720p = $video_720p;
    }

    /**
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param array $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }


}