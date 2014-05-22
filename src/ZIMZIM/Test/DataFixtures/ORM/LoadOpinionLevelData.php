<?php

namespace ZIMZIM\Test\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel;

class LoadOpinionLevelData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $om)
    {
        $level = new OpinionLevel();
        $level->setName('Trés bon');
        $level->setStars(5);
        $this->addReference('level5', $level);
        $om->persist($level);

        $level = new OpinionLevel();
        $level->setName('Bon');
        $level->setStars(4);
        $this->addReference('level4', $level);
        $om->persist($level);

        $level = new OpinionLevel();
        $level->setName('Correct');
        $level->setStars(3);
        $this->addReference('level3', $level);
        $om->persist($level);

        $level = new OpinionLevel();
        $level->setName('J\'ai vus mieux');
        $level->setStars(2);
        $this->addReference('level2', $level);
        $om->persist($level);

        $level = new OpinionLevel();
        $level->setName('Méme pas en rêve');
        $level->setStars(1);
        $this->addReference('level1', $level);
        $om->persist($level);

        $om->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
