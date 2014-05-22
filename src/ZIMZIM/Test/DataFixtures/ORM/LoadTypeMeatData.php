<?php

namespace ZIMZIM\Test\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\OpinionBundle\Entity\TypeMeat;

class LoadTypeMeatData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $om)
    {
        $type = new TypeMeat();
        $type->setName('Traditionnel');
        $this->addReference('TypeMeat1', $type);
        $om->persist($type);

        $type = new TypeMeat();
        $type->setName('Hallal');
        $this->addReference('TypeMeat2', $type);
        $om->persist($type);

        $om->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
