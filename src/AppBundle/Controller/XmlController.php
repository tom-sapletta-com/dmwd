<?php

namespace AppBundle\Controller;

use AppBundle\Video;
use AppBundle\Videos;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Doctrine\ORM\EntityManagerInterface;


class XmlController extends Controller
{

    /**
     * @param $url
     * @return Videos
     */
    protected function getVideos($url)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $data = file_get_contents($url);

        /** @var Videos $videos */
        $videos = $serializer->deserialize($data, Videos::class, 'xml');
        return $videos;
    }

    /**
     * @param Videos $videos
     * @param $date
     * @return array
     */
    protected function getVideoArrayByDate(Videos $videos, $date)
    {
        $video_array = [];
        /** @var Video $video */
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
        /** @var Video $video */
        foreach ($videos->getVideos() as $video) {
            $menu_array[$video->getDate()] = [
                'url' => '/video/' . $video->getDate(),
                'title' => $video->getDate()
            ];
        }
        return $menu_array;
    }

    /**
     * @Route("/list", name="video list")
     */
    public function listAction(Request $request)
    {
        /** @var Videos $videos */
        $videos = $this->getVideos('http://pluton/xml/xml.xml');

        /** @var array $menu_array */
        $menu_array = $this->getMenuArrayFromVideos($videos);

        return $this->render('xml/list.html.twig', [
            'menu_array' => $menu_array,
        ]);
    }

    /**
     * @Route("/video/{date}")
     */
    public function videoAction(Request $request, $date)
    {
        /** @var Videos $videos */
        $videos = $this->getVideos('http://pluton/xml/xml.xml');

        /** @var Videos $videos */
        $video_array = $this->getVideoArrayByDate($videos, $date);

        return $this->render('xml/video.html.twig', [
            'video_array' => $video_array
        ]);
    }

    /**
     * @Route("/all", name="video")
     */
    public function allAction(Request $request)
    {
        $articles = [
            [
                'url' => '/',
                'title' => 'Start',
            ],
            [
                'url' => '/menu',
                'title' => 'Menu',
            ]
        ];

        /** @var Videos $videos */
        $videos = $this->getVideos('http://pluton/xml/xml.xml');

        return $this->render('xml/video.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'video_array' => $videos->getVideos(),
        ]);
    }

    /**
     * @Route("/import", name="import XML to DB")
     */
    public function importAction(Request $request)
    {
        /** @var Videos $videos */
        $videos = $this->getVideos('http://pluton/xml/xml.xml');

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        /** @var Video $video */
        foreach ($videos->getVideos() as $video) {

            /** @var \AppBundle\Entity\Video $video_entity */
            $video_entity = new \AppBundle\Entity\Video();
//            $video_entity->setDate($video->getDate());
//            $video_entity->setReleased($video->getReleased());
//            $video_entity->setDuration($video->getDuration());
//            $video_entity->setTitle($video->getTitle());
//            $video_entity->setDescription($video->getDescription());
//
//            $video_entity->setAuthor($video->getAuthor());
//            $video_entity->setPicture($video->getPicture());
//            $video_entity->setVideo240p($video->getVideo240p());
//            $video_entity->setVideo360p($video->getVideo360p());
//            $video_entity->setVideo480p($video->getVideo480p());
//            $video_entity->setVideo720p($video->getVideo720p());
//            $video_entity->setBlacklist(0);
//            $video_entity->set($video->get());


            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($video_entity);
            break;
            // actually executes the queries (i.e. the INSERT query)
        }
        $em->flush();


        return $this->render('xml/video.html.twig', [
            'video_array' => $videos->getVideos()
        ]);
    }

    /**
     * @Route("/show/{$videoId}", "show from DB")
     */
//    public function showAction(Request $request, $videoId)
//    {
//        $video = $this->getDoctrine()
//            ->getRepository(\AppBundle\Entity\Video::class)
//            ->find($videoId);
//
//        if (!$videoId) {
//            throw $this->createNotFoundException(
//                'No product found for id ' . $videoId
//            );
//        }
//        return $this->render('xml/video.html.twig', [
//            'video_array' => [$video]
//        ]);
//    }

}
