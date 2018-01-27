<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Controller qui sert les routes AJAX des commentaires de produit
 * Simule une API externe pour la démo de VueJS
 */
class CommentController extends Controller
{
    /**
     * Action qui sert les commentaires d'un produit
     *
     * @Route("/comments/{productId}", name="commentForProduct", requirements={"productId"="\d+"})
     * @param Request $request
     * @param integer $productId
     * @return Response
     * @throws NotFoundException Si le produit n'existe pas
     */
    public function indexAction(Request $request, $productId)
    {
        /** @var \AppBundle\Manager\CommentManager $commentManager */
        $commentManager = $this->get("comment_manager");
        /** @var \AppBundle\Manager\ProductManager $productManager */
        $productManager = $this->get('product_manager');

        $product = $productManager->getProductById($productId);
        if(!$product) {
            throw new NotFoundHttpException();
        }
        $comments = $commentManager->getCommentsForProduct($product);

        return new JsonResponse(array(
            "productId" => $product->getId(),
            "commentCount" => count($comments),
            "comments" => \array_map(function($comment){
                return $comment->serialize();
            }, $comments)
        ));
    }
}