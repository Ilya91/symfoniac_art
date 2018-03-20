<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository implements UserProviderInterface
{
	/**
	 * @param $username
	 *
	 * @return mixed
	 */
	public function findOneByUsernameOrEmail($username)
	{
		try {
			return $this->createQueryBuilder( 'u' )
			            ->andWhere( 'u.username = :username OR u.email = :email' )
			            ->setParameter( 'username', $username )
			            ->setParameter( 'email', $username )
			            ->getQuery()
			            ->getOneOrNullResult();
		} catch ( NonUniqueResultException $e ) {
		}
	}

	/**
	 * Loads the user for the given username.
	 *
	 * This method must throw UsernameNotFoundException if the user is not
	 * found.
	 *
	 * @param string $username The username
	 *
	 * @return UserInterface
	 *
	 * @throws UsernameNotFoundException if the user is not found
	 */
	public function loadUserByUsername( $username ) {
		$user = $this->findOneByUsernameOrEmail($username);

		if (!$user) {
			throw new UsernameNotFoundException('No user found for username '.$username);
		}

		return $user;
	}

	/**
	 * Refreshes the user.
	 *
	 * It is up to the implementation to decide if the user data should be
	 * totally reloaded (e.g. from the database), or if the UserInterface
	 * object can just be merged into some internal array of users / identity
	 * map.
	 *
	 * @param UserInterface $user
	 *
	 * @return UserInterface
	 *
	 */
	public function refreshUser(UserInterface $user)
	{
		$class = get_class($user);
		if (!$this->supportsClass($class)) {
			throw new UnsupportedUserException(sprintf(
				'Instances of "%s" are not supported.',
				$class
			));
		}

		if (!$refreshedUser = $this->find($user->getId())) {
			throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($user->getId())));
		}

		return $refreshedUser;
	}

	/**
	 * Whether this provider supports the given user class.
	 *
	 * @param string $class
	 *
	 * @return bool
	 */
	public function supportsClass($class)
	{
		return $this->getEntityName() === $class
		       || is_subclass_of($class, $this->getEntityName());
	}
}
