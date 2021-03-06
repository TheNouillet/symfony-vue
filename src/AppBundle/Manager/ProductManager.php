<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\ProductRepository;
use AppBundle\Entity\ProductSearch;

/**
 * Manager de l'entité Produit
 */
class ProductManager extends BaseManager
{
    const MAX_PER_PAGE = 10;

    /**
     * Repository de Product
     *
     * @var ProductRepository
     */
    protected $repository;

    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->repository = $this->entityManager->getRepository("AppBundle:Product");
    }

    /**
     * Récupère les produits d'une page
     *
     * @param integer $page
     * @return Product[]
     */
    public function getProductsByPage($page)
    {
        return $this->repository->findBy([], [], self::MAX_PER_PAGE, ($page - 1) * self::MAX_PER_PAGE);
    }

    /**
     * Recherche les produits d'une page
     *
     * @param ProductSearch $search
     * @param integer $page
     * @return Product[]
     */
    public function searchProductsByPage(ProductSearch $search, $page)
    {
        return $this->repository->searchProductByPage($search, self::MAX_PER_PAGE, ($page - 1) * self::MAX_PER_PAGE);
    }

    /**
     * Renvoie le nombre de produits d'une recherche
     *
     * @param ProductSearch $search
     * @return integer
     */
    public function seachProductsCount(ProductSearch $search)
    {
        return $this->repository->searchProductCount($search);
    }

    /**
     * Récupère un produit avec son ID
     *
     * @param integer $id
     * @return Product
     */
    public function getProductById($id)
    {
        return $this->repository->find($id);
    }
}