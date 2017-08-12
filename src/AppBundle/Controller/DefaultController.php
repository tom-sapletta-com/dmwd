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

class DefaultController extends Controller
{
    /**
     * list of Url's
     * @var array
     */
    protected $url_array = [
        'http://mgr.gcdn.eu/xml?key=jSlnt4zudGG28wbglUyK8MqLZ6TXD-sYD3d0fUN7zMCwaWmABIL&mindate=2017-04-01',
        'http://pluton/xml/xml.xml'
    ];

    protected $url_default = 1;

    /** @var array */
    protected $menu_array = [
        [
            'url' => '/',
            'title' => 'Home',
        ],
        [
            'url' => '/xml/all',
            'title' => 'XML: Show All',
        ],
        [
            'url' => '/xml/list',
            'title' => 'XML: Videos By Date',
        ],
        [
            'url' => '/xml/import/1',
            'title' => 'Import XML Data to DB',
        ],
        [
            'url' => '/db/all',
            'title' => 'DB: Show All',
        ],
        [
            'url' => '/db/by/id',
            'title' => 'DB: Videos By Id',
        ],
        [
            'url' => '/db/by/date',
            'title' => 'DB: Videos By Date',
        ],
        [
            'url' => '/db/blacklist',
            'title' => 'DB: All Blacklist option',
        ],
        [
            'url' => '/db/blacklist/1',
            'title' => 'DB/Videos/Blacklist/1 - On the Black list ',
        ],
        [
            'url' => '/db/blacklist/0',
            'title' => 'DB/Videos/Blacklist/0 - Not on Black list',
        ],
        [
            'url' => '/db/update/1',
            'title' => 'Update ALl XML Data which are not on blacklist',
        ],
    ];

    /**
     * @param int $id
     * @return mixed
     */
    protected function getUrl($id = 1)
    {
        return $this->url_array[$id];
    }

    /**
     * @param array $menu_array
     * @param Request $request
     * @return array
     */
    protected function getMenu(array $menu_array, Request $request)
    {
        foreach ($menu_array as $key => $menu){
            $menu_array[$key]['url'] = $request->getBaseUrl() . $menu_array[$key]['url'];
        }
        return $menu_array;
    }

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
        if (empty($data)) {
            return null;
        }

        /** @var Videos $videos */
        $videos = $serializer->deserialize($data, Videos::class, 'xml');
        return $videos;
    }

    /**
     * @param \AppBundle\Xml\Videos $video_xml
     */
    protected function importFromXml(\AppBundle\Xml\Videos $video_xml)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();

        /** @var \AppBundle\Xml\Video $video */
        foreach ($video_xml->getVideos() as $video) {

            /** @var \AppBundle\Entity\Videos $video_entity */
            $video_entity = new \AppBundle\Entity\Videos();

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
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'video_list' => [],
            'video_menu_list' => [],
            'menu_list' => $this->getMenu($this->menu_array, $request),
            'message' => ''
        ]);
    }
}
