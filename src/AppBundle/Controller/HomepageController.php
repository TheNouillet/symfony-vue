<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomepageController extends Controller
{
    /**
     * Action qui sert la homepage
     *
     * @Route("/", name="home")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        /** @var \AppBundle\Manager\ProductManager $manager */
        $manager = $this->get("product_manager");

        $products = $manager->getProductsByPage(1);
        
        return $this->render("AppBundle:Homepage:index.html.twig", [
            "products" => $products
        ]);
    }
}