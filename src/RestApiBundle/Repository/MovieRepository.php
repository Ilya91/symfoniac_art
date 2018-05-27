<?php

namespace RestApiBundle\Repository;

/**
 * MovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovieRepository extends \Doctrine\ORM\EntityRepository
{
    public function count()
    {
        $qb = $this->createQueryBuilder('m');

        return $qb->select('count(m.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
