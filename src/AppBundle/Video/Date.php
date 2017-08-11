<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2017-08-11
 * Time: 11:23
 */

namespace AppBundle\Video;
use \DateTime;

/**
 * Class Date
 * @package AppBundle\Video
 */
class Date
{
    /** @var timestamp */
    private $data;

    /**
     * @param $data
     */
    public function fromString($data)
    {
        $this->setData(new DateTime($data));
    }

    /**
     * @return DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param DateTime $data
     */
    protected function setData(DateTime $data)
    {
        $this->data = $data;
    }
}