<?php

namespace AppBundle\Controller;

use AppBundle\Xml\Video;
use AppBundle\Xml\Videos;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class XmlController extends DefaultController
{
    /**
     * @param Videos $videos
     * @param $date
     * @return array
     */
    protected function getVideoArrayByDate(Videos $videos, $date)
    {
        $video_array = [];
        /** @var \AppBundle\Xml\Video $video */
        foreach ($videos->getVideos() as $video) {
            if ($video->getDate() == $date) {
                $video_array[] = $video;
            }
        }
        return $video_array;
    }

    /**
     * @param $videos
     * @return array
     */
    protected function getMenuArrayFromVideos(Videos $videos)
    {
        $menu_array = [];
        /** @var \AppBundle\Xml\Video $video */
        foreach ($videos->getVideos() as $video) {
            $menu_array[$video->getDate()] = [
                'url' => '/xml/video/' . $video->getDate(),
                'title' => $video->getDate() . ' . ' . $video->getTitle() . ' ... '
            ];
        }
        return $menu_array;
    }

    /**
     * @Route("/xml/all", name="video")
     */
    public function allAction(Request $request)
    {
        $message = '';

        /** @var Videos $videos */
        $videos = $this->getVideos($this->getUrl($this->url_default));

        if(empty($videos)){
            $message = 'Empty File: ' . $this->getUrl($this->url_default);
            $video_list = [];
        } else {
            $video_list = $videos->getVideos();
        }
        return $this->render('xml/video.html.twig', [
            'video_list' => $video_list,
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'message' => $message,
        ]);
    }

    /**
     * @Route("/xml/list", name="video list")
     */
    public function listAction(Request $request)
    {
        $message = '';

        /** @var Videos $videos */
        $videos = $this->getVideos($this->getUrl($this->url_default));

        if(empty($videos)){
            $message = 'Empty File: ' . $this->getUrl($this->url_default);
            $video_menu_list = [];
        } else {
            /** @var array $menu_array */
            $video_menu_list = $this->getMenuArrayFromVideos($videos);
        }

        return $this->render('xml/list.html.twig', [
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_menu_list' => $video_menu_list,
            'video_list' => [],
            'message' => $message,
        ]);
    }

    /**
     * @Route("/xml/video/{date}")
     */
    public function videoAction(Request $request, $date)
    {
        $message = '';

        /** @var Videos $videos */
        $videos = $this->getVideos($this->getUrl($this->url_default));

        /** @var Videos $videos */
        $video_list = $this->getVideoArrayByDate($videos, $date);

        return $this->render('xml/video.html.twig', [
            'video_list' => $video_list,
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'message' => $message,
        ]);
    }

    /**
     * import/1
     *
     * @Route("/xml/import/{id}", name="import XML to DB")
     */
    public function importAction(Request $request, $id)
    {
        $video_import = [];
        $message = '';

        /** @var Videos $videos */
        $videos = $this->getVideos($this->getUrl($id));
        if(empty($videos)){
            $message = 'Empty File: ' . $this->getUrl($id);
        } else {
            $this->importFromXml($videos);
            $video_import = $videos->getVideos();
        }

        return $this->render('xml/import.html.twig', [
            'video_import' => $video_import,
            'video_list' => [],
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'message' => $message,
        ]);
    }


}
