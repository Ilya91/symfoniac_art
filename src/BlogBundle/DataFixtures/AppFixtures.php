<?php
namespace BlogBundle\DataFixtures;

use BlogBundle\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
		// create 20 products! Bam!
		for ($i = 0; $i < 20; $i++) {
			$datetime = new \DateTime('now');
			$post = new Post();
			$post->setTitle('post '.$i);
			$post->setDescription('description ' . $i);
			$post->setContent('content ' . $i);
			$post->setCreatedAt($datetime);
			$post->setUpdatedAt($datetime);
			$manager->persist($post);
		}

		$manager->flush();
	}
}