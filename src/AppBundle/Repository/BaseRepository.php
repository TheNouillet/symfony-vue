<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository
{
    public function getCount()
    {
        return $this->createQueryBuilder("e")
            ->select("count(e.id)")
            ->getQuery()
            ->getSingleScalarResult();
    }
}