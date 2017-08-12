<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2017-08-10
 * Time: 20:22
 */

namespace AppBundle\Xml;

/**
 * Class Video
 * @package AppBundle\Xml
 */
class Video
{
    /** @var integer */
    private $id;

    /** @var string */
    private $released;

    /** @var string */
    private $duration;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $date;

    /** @var string */
    private $author;

    /** @var string */
    private $picture;

    /** @var string */
    private $video_240p;

    /** @var string */
    private $video_360p;

    /** @var string */
    private $video_480p;

    /** @var string */
    private $video_720p;

    /** @var array */
    private $keywords = [];

    /** @var array */
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

        $this->setId($child['id']);
        $this->setReleased($child['released']);

        $this->setDuration('00:00:00');
        if (!empty($child['duration'])) {
            $this->setDuration($child['duration']);
        }

        $this->setTitle($child['title']);
        $this->setDescription($child['description']);

        $this->setDate($child['date']);

        $this->setAuthor($child['author']);
        $this->setPicture($child['picture']);
        $this->setVideo240p($child['video_240p']);
        $this->setVideo360p($child['video_360p']);
        $this->setVideo480p($child['video_480p']);
        $this->setVideo720p($child['video_720p']);
        $this->setKeywords($child['keywords']);
        $this->setCategories($child['categories']);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Video
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param string $released
     * @return Video
     */
    public function setReleased($released)
    {
        $this->released = $released;
        return $this;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     * @return Video
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Video
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Video
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return Video
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Video
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return Video
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo240p()
    {
        return $this->video_240p;
    }

    /**
     * @param string $video_240p
     * @return Video
     */
    public function setVideo240p($video_240p)
    {
        $this->video_240p = $video_240p;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo360p()
    {
        return $this->video_360p;
    }

    /**
     * @param string $video_360p
     * @return Video
     */
    public function setVideo360p($video_360p)
    {
        $this->video_360p = $video_360p;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo480p()
    {
        return $this->video_480p;
    }

    /**
     * @param string $video_480p
     * @return Video
     */
    public function setVideo480p($video_480p)
    {
        $this->video_480p = $video_480p;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo720p()
    {
        return $this->video_720p;
    }

    /**
     * @param string $video_720p
     * @return Video
     */
    public function setVideo720p($video_720p)
    {
        $this->video_720p = $video_720p;
        return $this;
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
     * @return Video
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
        return $this;
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
     * @return Video
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

}