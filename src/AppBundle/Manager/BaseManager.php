<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;

class BaseManager
{
    /**
     * Manger d'entité Symfony
     *
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
}