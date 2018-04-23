<?php

namespace RestApiBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use RestApiBundle\Entity\Movie;

class LoadMovieData extends Fixture {

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param ObjectManager $manager
	 */
	public function load( ObjectManager $manager ) {

		for ($i = 0; $i < 20; $i++) {
			$movie1 = new Movie();
			$movie1->setTitle( 'Title movie' );
			$movie1->setYear( 2007 );
			$movie1->setTime( 202 );
			$movie1->setDescription( 'The best movie' );
			$manager->persist( $movie1 );
		}
		$manager->flush();
	}
}