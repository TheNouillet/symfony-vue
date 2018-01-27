<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Controller qui sert les pages produits
 */
class ProductsController extends Controller
{
    /**
     * Action qui sert la liste des produits
     *
     * @Route("/products", name="productsList")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        /** @var \AppBundle\Manager\ProductManager $manager */
        $manager = $this->get("product_manager");

        // On récupère le numéro de la page
        $page = $request->query->get("page", 1);

        // On récupère les produits de la base de données
        $products = $manager->getProductsByPage($page);

        // On renvoie la page
        return $this->render("AppBundle:Products:list.html.twig", array(
            "products" => $products,
            "page" => $page
        ));
    }
}