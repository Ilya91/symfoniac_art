<?php

namespace RestApiBundle\DataFixtures\ORM;

use RestApiBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LoadUserData extends Fixture  implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setPassword($this->encodePassword($user1, 'admin'));
        $user1->setEmail('admin@admin.com');
        $user1->setIsActive(true);
        $user1->setRoles([User::ROLE_ADMIN]);

        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('user');
        $user2->setPassword($this->encodePassword($user2, 'user'));
        $user2->setEmail('user@user.com');
        $user2->setIsActive(false);
        $user2->setRoles([User::ROLE_USER]);

        $manager->persist($user2);

        $manager->flush();
    }

    /**
     * Sets the container.
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function encodePassword(User $user, $plainPassword){
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
}