<?php
namespace UserBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class UserFixtures extends Fixture implements ContainerAwareInterface
{
	private $container;
	public function load(ObjectManager $manager)
	{
		$user = new User();
		$user->setUsername('user');
		$user->setPassword($this->encodePassword($user, 'user'));
		$user->setEmail('user@user.com');
		$user->setIsActive(false);
		$manager->persist($user);
		$manager->flush();
	}

	public function setContainer( ContainerInterface $container = null ) {
		$this->container = $container;
	}

	private function encodePassword(User $user, $plainPassword){
		$encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
		return $encoder->encodePassword($plainPassword, $user->getSalt());
	}
}