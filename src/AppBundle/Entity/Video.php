<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity
 */
class Video
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="released", type="datetime", nullable=false)
     */
    private $released;

    /**
     * @var string
     *
     * @ORM\Column(name="duration", type="string", length=12, nullable=false)
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=16, nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=50, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=100, nullable=false)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="video_240p", type="string", length=100, nullable=false)
     */
    private $video240p;

    /**
     * @var string
     *
     * @ORM\Column(name="video_360p", type="string", length=100, nullable=false)
     */
    private $video360p;

    /**
     * @var string
     *
     * @ORM\Column(name="video_480p", type="string", length=100, nullable=false)
     */
    private $video480p;

    /**
     * @var string
     *
     * @ORM\Column(name="video_720p", type="string", length=100, nullable=false)
     */
    private $video720p;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blacklist", type="boolean", nullable=true)
     */
    private $blacklist = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return \DateTime
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param \DateTime $released
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
        return $this->video240p;
    }

    /**
     * @param string $video240p
     * @return Video
     */
    public function setVideo240p($video240p)
    {
        $this->video240p = $video240p;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo360p()
    {
        return $this->video360p;
    }

    /**
     * @param string $video360p
     * @return Video
     */
    public function setVideo360p($video360p)
    {
        $this->video360p = $video360p;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo480p()
    {
        return $this->video480p;
    }

    /**
     * @param string $video480p
     * @return Video
     */
    public function setVideo480p($video480p)
    {
        $this->video480p = $video480p;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideo720p()
    {
        return $this->video720p;
    }

    /**
     * @param string $video720p
     * @return Video
     */
    public function setVideo720p($video720p)
    {
        $this->video720p = $video720p;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Video
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * @param bool $blacklist
     * @return Video
     */
    public function setBlacklist($blacklist)
    {
        $this->blacklist = $blacklist;
        return $this;
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


}

