<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductSearch
 *
 * @ORM\Table(name="product_search")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductSearchRepository")
 */
class ProductSearch
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="minPrice", type="float")
     */
    private $minPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="maxPrice", type="float")
     */
    private $maxPrice;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set minPrice
     *
     * @param float $minPrice
     * @return ProductSearch
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    /**
     * Get minPrice
     *
     * @return float 
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * Set maxPrice
     *
     * @param float $maxPrice
     * @return ProductSearch
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get maxPrice
     *
     * @return float 
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }
}
