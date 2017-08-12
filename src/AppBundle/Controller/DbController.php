<?php

namespace AppBundle\Controller;

use AppBundle\Xml\Video;
use AppBundle\Xml\Videos;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Doctrine\ORM\EntityManagerInterface;


class DbController extends DefaultController
{

    protected $video_blacklist = [];

    /**
     * @return array
     */
    public function getVideoBlacklist()
    {
        return $this->video_blacklist;
    }

    /**
     * @param array $video_blacklist
     */
    public function setVideoBlacklist($video_blacklist)
    {
        $this->video_blacklist = $video_blacklist;
    }

    /**
     * @param $video_id
     */
    public function addVideoBlacklist($video_id)
    {
        $this->video_blacklist[] = $video_id;
    }

    /**
     * @param \AppBundle\Xml\Video $video
     * @return bool
     */
    protected function isVideoOnBlacklist(\AppBundle\Xml\Video $video)
    {
        return in_array($video->getId(), $this->getVideoBlacklist());
    }


    /**
     * @param \AppBundle\Entity\Videos[] $videos
     * @return array
     */
    protected function updateBlacklistIdArrayFromVideos(array $videos)
    {
        $this->setVideoBlacklist([]);
        /** @var \AppBundle\Entity\Videos $video */
        foreach ($videos as $video) {
            $this->addVideoBlacklist($video->getXmlId());
        }
        return $this;
    }


    /**
     * @param array $videos
     * @return array
     */
    protected function getMenuBlacklistArrayFromVideos(array $videos)
    {
        $menu_array = [];
        /** @var \AppBundle\Entity\Videos $video */
        foreach ($videos as $video) {
            $menu_array[] = [
                'id' => $video->getId(),
                'xml_id' => $video->getXmlId(),
                'status' => (integer)$video->isBlacklist(),
                'inverted_status' => (integer)!(boolean)$video->isBlacklist(),
                'title' => $video->getTitle()
            ];
        }
        return $menu_array;
    }

    /**
     * @param array $videos
     * @return array
     */
    protected function getMenuIdArrayFromVideos(array $videos)
    {
        $menu_array = [];
        /** @var \AppBundle\Entity\Videos $video */
        foreach ($videos as $video) {
            $menu_array[$video->getId()] = [
                'url' => '/db/video/id/' . $video->getId(),
                'title' => $video->getId() . ' . ' . $video->getTitle()
            ];
        }
        return $menu_array;
    }

    /**
     * @param array $videos
     * @return array
     */
    protected function getMenuDateArrayFromVideos(array $videos)
    {
        $menu_array = [];
        /** @var \AppBundle\Entity\Videos $video */
        foreach ($videos as $video) {
            $menu_array[$video->getDate()] = [
                'url' => '/db/video/date/' . $video->getDate(),
                'title' => $video->getDate() . ' . ' . $video->getTitle() . ' ... '
            ];
        }
        return $menu_array;
    }

    /**
     * @param \AppBundle\Xml\Video[] $video_xml
     */
    protected function updateFromXml(array $video_xml)
    {
        $em = $this->getDoctrine()->getManager();

//        var_dump($video_xml);
        /** @var \AppBundle\Xml\Video $video */
        foreach ($video_xml as $video) {

            if (!($video instanceof Video)) {
                continue;
            }

            /** @var \AppBundle\Entity\Videos $video */
            $video_entity = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Videos::class)
                ->findOneByXmlId($video->getId());

            // Create New if xml_id not Exist in DB
            if (empty($video_entity)) {
                /** @var \AppBundle\Entity\Videos $video_entity */
                $video_entity = new \AppBundle\Entity\Videos();
            }

            $video_entity->setXmlId($video->getId());
            $video_entity->setReleased(new \DateTime($video->getReleased()));
            $video_entity->setDuration((string)$video->getDuration());
            $video_entity->setTitle((string)$video->getTitle());
            $video_entity->setDescription((string)$video->getDescription());
            $video_entity->setDate($video->getDate());

            $video_entity->setAuthor($video->getAuthor());
            $video_entity->setPicture($video->getPicture());
            $video_entity->setVideo240p($video->getVideo240p());
            $video_entity->setVideo360p($video->getVideo360p());
            $video_entity->setVideo480p($video->getVideo480p());
            $video_entity->setVideo720p($video->getVideo720p());

            $video_entity->setKeywords($video->getKeywords());

            $video_entity->setCategories($video->getCategories());

            $video_entity->setBlacklist(false);
            $video_entity->setCreatedAt(new \DateTime("now"));

            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($video_entity);


        }

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
    }


    /**
     * @Route("/db/by/id")
     */
    public function byIdAction(Request $request)
    {
        $message = '';

        /** @var \AppBundle\Entity\Videos $video */
        $videos = $this->getDoctrine()
            ->getRepository(\AppBundle\Entity\Videos::class)
            ->findAll();

        /** @var array $menu_array */
        $video_menu_list = $this->getMenuIdArrayFromVideos($videos);

        return $this->render('db/list.html.twig', [
            'video_menu_list' => $video_menu_list,
            'video_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_import' => [],
            'message' => $message
        ]);
    }

    /**
     * @Route("/db/by/date")
     */
    public function byDateAction(Request $request)
    {
        $message = '';

        /** @var \AppBundle\Entity\Videos $video */
        $videos = $this->getDoctrine()
            ->getRepository(\AppBundle\Entity\Videos::class)
            ->findAll();

        /** @var array $menu_array */
        $video_menu_list = $this->getMenuDateArrayFromVideos($videos);

        return $this->render('db/list.html.twig', [
            'video_menu_list' => $video_menu_list,
            'video_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_import' => [],
            'message' => $message
        ]);
    }

    /**
     * @Route("/db/video/id/{videoId}")
     */
    public function videoIdAction(Request $request, $videoId)
    {
        $message = '';

        /** @var \AppBundle\Entity\Videos $video */
        $video = $this->getDoctrine()
            ->getRepository(\AppBundle\Entity\Videos::class)
            ->find($videoId);

        if (!$videoId) {
            throw $this->createNotFoundException(
                'No product found for id ' . $videoId
            );
        }
        return $this->render('db/video.html.twig', [
            'video_list' => [$video],
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_import' => [],
            'message' => $message
        ]);
    }

    /**
     * @Route("/db/video/date/{videoDate}")
     */
    public function videoDateAction(Request $request, $videoDate)
    {
        $message = '';

        /** @var \AppBundle\Entity\Videos $video */
        $video = $this->getDoctrine()
            ->getRepository(\AppBundle\Entity\Videos::class)
            ->findByDate($videoDate);

        if (!$videoDate) {
            throw $this->createNotFoundException(
                'No product found for Date ' . $videoDate
            );
        }
        return $this->render('db/video.html.twig', [
            'video_list' => $video,
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_import' => [],
            'message' => $message
        ]);
    }

    /**
     * @Route("/db/all")
     */
    public function allAction(Request $request)
    {
        $message = '';

        /** @var \AppBundle\Entity\Videos $video */
        $video_list = $this->getDoctrine()
            ->getRepository(\AppBundle\Entity\Videos::class)
            ->findAll();

        return $this->render('db/video.html.twig', [
            'video_list' => $video_list,
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_import' => [],
            'message' => $message
        ]);
    }

    /**
     * @Route("/db/blacklist")
     */
    public function blacklistAction(Request $request)
    {
        $message = '';

        /** @var \AppBundle\Entity\Videos $video */
        $video_list = $this->getDoctrine()
            ->getRepository(\AppBundle\Entity\Videos::class)
            ->findAll();

        $video_checkbox_list = $this->getMenuBlacklistArrayFromVideos($video_list);

        return $this->render('db/blacklist.html.twig', [
            'video_list' => [],
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_import' => [],
            'video_checkbox_list' => $video_checkbox_list,
            'message' => $message
        ]);
    }

    /**
     * @Route("/db/blacklist/{status}")
     */
    public function blacklistStatusAction(Request $request, $status)
    {
        $message = '';
        /** @var \AppBundle\Entity\Videos $video */
        $video_list = $this->getDoctrine()
            ->getRepository(\AppBundle\Entity\Videos::class)
            ->findByBlacklist($status);

        $video_checkbox_list = $this->getMenuBlacklistArrayFromVideos($video_list);

        return $this->render('db/blacklist.html.twig', [
            'video_list' => [],
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'video_import' => [],
            'video_checkbox_list' => $video_checkbox_list,
            'message' => $message
        ]);
    }


    /**
     * @Route("/db/blacklist/id/{videoId}/status/{status}")
     */
    public function blacklistSetStatusByVideoIdAction(Request $request, $videoId, $status)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var \AppBundle\Entity\Videos $video */
        $video = $em->getRepository(\AppBundle\Entity\Videos::class)
            ->findOneById($videoId);

        $video->setBlacklist((boolean)$status);

        $em->flush();

        $response = $this->forward('AppBundle:Db:blacklistStatus', array(
            'status' => (integer)!(boolean)$status,
        ));

        return $response;
    }

    /**
     * @param Videos $video_xml
     * @param $video_blacklist
     * @return array
     */
    protected function getRemovedVideosByIdArray(Videos $video_xml, $video_blacklist)
    {
        $this->updateBlacklistIdArrayFromVideos($video_blacklist);

        $video_xml_not_in_blacklist = [];

        /** @var \AppBundle\Xml\Video $video */
        foreach ($video_xml->getVideos() as $video) {
            if (!$this->isVideoOnBlacklist($video)) {
                $video_xml_not_in_blacklist[$video->getId()] = $video;
            }
        }
        return $video_xml_not_in_blacklist;

    }

    /**
     * import/1
     *
     * @Route("/db/update/{id}", name="Update ALl XML Data which are not on blacklist")
     */
    public function updateFromXmlAction(Request $request, $id)
    {
        /** @var Videos $video_xml */
        $video_xml = $this->getVideos($this->getUrl($id));
        $video_xml_not_in_blacklist = [];
        $message = '';

        if (empty($video_xml)) {
            $message = 'Empty File: ' . $this->getUrl($id);
        } else {
            /** @var \AppBundle\Entity\Videos $video */
            $video_blacklist = $this->getDoctrine()
                ->getRepository(\AppBundle\Entity\Videos::class)
                ->findByBlacklist(1);

            if (empty($video_blacklist)) {

                $video_xml_not_in_blacklist = $video_xml->getVideos();
                $this->importFromXml($video_xml);
            } else {
                $video_xml_not_in_blacklist = $this->getRemovedVideosByIdArray($video_xml, $video_blacklist);
                $this->updateFromXml($video_xml_not_in_blacklist);
            }
        }

//        var_dump($video_xml_not_in_blacklist);

        return $this->render('xml/import.html.twig', [
            'video_import' => $video_xml_not_in_blacklist,
            'video_list' => [],
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'message' => $message
        ]);
    }

}
