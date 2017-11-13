<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Service\ProductParser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route("/process/xml/feed", options={"expose"=true}, name="process_feed")
     * @Template("AppBundle:Default:index.html.twig")
     * @Method("POST")
     */
    public function processFeedAction(Request $request)
    {
        $data = json_decode($request->getContent());

        $productParser = $this->get(ProductParser::class);
        $document = $productParser->loadXML($data->feedURL);
        $products = $productParser->parseDocument($document);

        return new JsonResponse($products);   
    }

}
