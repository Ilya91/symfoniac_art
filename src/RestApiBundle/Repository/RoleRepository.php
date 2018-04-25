<?php

namespace RestApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository
{
	/**
	 * @param int $movieId
	 *
	 * @return mixed
	 * @throws \Doctrine\ORM\NoResultException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function getCountForMovie($movieId)
	{
		$qb = $this->createQueryBuilder('r');

		return $qb->select('count(r.id)')
		          ->where('r.movie = :movieId')
		          ->setParameter('movieId', $movieId)
		          ->getQuery()
		          ->getSingleScalarResult();
	}
}