<?php

namespace ZIMZIM\Bundles\OpinionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\OpinionBundle\Entity\TypeButchery;

class LoadTypeButcheryData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $om)
    {
        $type = new TypeButchery();
        $type->setName('Traditionnel');
        $this->addReference('TypeButchery1', $type);
        $om->persist($type);

        $type = new TypeButchery();
        $type->setName('Hypermaché');
        $this->addReference('TypeButchery2', $type);
        $om->persist($type);

        $type = new TypeButchery();
        $type->setName('Discount');
        $this->addReference('TypeButchery3', $type);
        $om->persist($type);

        $om->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
