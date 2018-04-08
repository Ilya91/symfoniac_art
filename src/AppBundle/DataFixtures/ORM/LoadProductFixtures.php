<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LoadProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $objects = Fixtures::load(__DIR__.'/fixtures.yml', $manager);
    }
}
