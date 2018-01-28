<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ProductSearch;


class ProductRepository extends BaseRepository
{
    /**
     * Undocumented function
     *
     * @param ProductSearch $search
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function prepareSearchQuery(ProductSearch $search)
    {
        $qb = $this->createQueryBuilder("p");
        if($search->getMinPrice()) {
            $qb->andWhere("p.price >= :minPrice");
            $qb->setParameter("minPrice", $search->getMinPrice());
        }
        if($search->getMaxPrice()) {
            $qb->andWhere("p.price <= :maxPrice");
            $qb->setParameter("maxPrice", $search->getMaxPrice());
        }
        return $qb;
    }

    /**
     * Effectue une recherche paginée de produits
     *
     * @param ProductSearch $search
     * @param integer $limit
     * @param integer $offset
     * @return Product[]
     */
    public function searchProductByPage(ProductSearch $search, $limit, $offset)
    {
        $qb = $this->prepareSearchQuery($search);
        $qb->setMaxResults($limit);
        $qb->setFirstResult($offset);

        return $qb->getQuery()->getResult();
    }

    public function searchProductCount(ProductSearch $search)
    {
        $qb = $this->prepareSearchQuery($search);
        $qb->select("count(p.id)");

        return $qb->getQuery()->getSingleScalarResult();
    }
}
