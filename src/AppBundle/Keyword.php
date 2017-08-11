<?php
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 2017-08-11
 * Time: 11:19
 */

namespace AppBundle;


class Keyword
{
    private $keyword;

    /**
     * @return mixed
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param mixed $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

}