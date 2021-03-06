<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{
	public function findAllByCostOrderedBySize($cost)
	{
		return $this->createQueryBuilder('p')
		            ->andWhere('p.cost > :cost')
		            ->setParameter('cost', $cost)
		            ->orderBy('p.createdAt', 'ASC')
					->getQuery()
					->getResult();
	}
}
