<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @uses  php bin/console doctrine:fixtures:load
     */
    public function load(ObjectManager $manager)
    {
        // seed pre-defined users
        for ($i = 1; $i <= 5; $i++) {
            $developer = new Developer();
            $developer->setName('DEV' . $i);
            $developer->setTaskDifficulty($i);
            $developer->setTaskDuration(1);
            $manager->persist($developer);
        }
        $manager->flush();
    }
}
