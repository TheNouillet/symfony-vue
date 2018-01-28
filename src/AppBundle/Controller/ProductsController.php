<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\ProductSearch;
use AppBundle\Form\ProductSearchType;

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

        $search = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $search);
        $form->handleRequest($request);

        // On récupère les produits de la base de données
        $products = $manager->searchProductsByPage($search, 1);
        $totalProductCount = $manager->seachProductsCount($search);

        // On renvoie la page
        return $this->render("AppBundle:Products:list.html.twig", array(
            "products" => $products,
            "totalProductCount" => $totalProductCount,
            "form" => $form->createView()
        ));
    }

    /**
     * Action qui sert une page de liste produit en JSON
     *
     * @Route("/products.json", name="ajaxProductsList")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajaxListAction(Request $request)
    {
        /** @var \AppBundle\Manager\ProductManager $manager */
        $manager = $this->get("product_manager");

        $page = $request->query->get("page", 1);
        $search = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $search);
        $form->handleRequest($request);

        // On récupère les produits de la base de données
        $products = $manager->searchProductsByPage($search, $page);

        return new JsonResponse(array(
            "page" => $page,
            "products" => \array_map(function($product){
                return $product->serialize();
            }, $products)
        ));
    }
}