<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\CommentRepository;

class CommentManager extends BaseManager
{
    /**
     * Repository de Commentaire
     *
     * @var CommentRepository
     */
    protected $repository;

    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->repository = $this->entityManager->getRepository("AppBundle:Comment");
    }

    /**
     * Renvoie les commentaires pour un produit
     *
     * @param Product $product
     * @return Comment[]
     */
    public function getCommentsForProduct(Product $product)
    {
        return $this->repository->findBy(array(
            "product" => $product
        ));
    }
}